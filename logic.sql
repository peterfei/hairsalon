--
-- Triggers `cost`
--
DROP TRIGGER IF EXISTS `tg_d_on_cost`;
DELIMITER //
CREATE TRIGGER `tg_d_on_cost` AFTER DELETE ON `cost`
 FOR EACH ROW begin
    select date_format(from_unixtime(old.created_at),'%y-%m-%d') into @delete_date; 
    if old.cid <> '' && old.action <> 'topup' then
        update overview_daily set card_cost = card_cost - old.real_pay, card_cost_num = card_cost_num - 1 where created_date = @delete_date;
    elseif old.cid <> '' && old.action = 'topup' then
        update overview_daily set card_topup = card_topup - old.real_pay where created_date = @delete_date;
    else
        update overview_daily set non_card_cost = non_card_cost - old.real_pay, non_card_cost_num = non_card_cost_num - 1 where created_date = @delete_date;
    end if;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_i_on_cost`;
DELIMITER //
CREATE TRIGGER `tg_i_on_cost` AFTER INSERT ON `cost`
 FOR EACH ROW begin
 select date_format(from_unixtime(new.created_at),'%y-%m-%d') into @insert_date;
 if not exists (select created_date from overview_daily where created_date = @insert_date) then
        if new.cid <> '' && new.action <> 'topup' then
            insert into overview_daily(card_cost, card_cost, created_date, created_time) values(new.real_pay, 1, @insert_date, unix_timestamp(@insert_date));
        elseif new.cid <> '' && new.action = 'topup' then
            insert into overview_daily(card_topup, created_date, created_time) values(new.real_pay, @insert_date, unix_timestamp(@insert_date));
        else
            insert into overview_daily(non_card_cost, non_card_cost_num, created_date, created_time) values(new.real_pay, 1, @insert_date, unix_timestamp(@insert_date));
        end if;
    else
        if new.cid <> '' && new.action <> 'topup' then
            update overview_daily set card_cost = card_cost + new.real_pay, card_cost_num = card_cost_num + 1 where created_date = @insert_date;
        elseif new.cid <> '' && new.action = 'topup' then
            update overview_daily set card_topup = card_topup + new.real_pay where created_date = @insert_date;
        else
            update overview_daily set non_card_cost = non_card_cost + new.real_pay, non_card_cost_num = non_card_cost_num + 1 where created_date = @insert_date;
        end if;
    end if;
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_u_on_cost`;
DELIMITER //
CREATE TRIGGER `tg_u_on_cost` AFTER UPDATE ON `cost`
 FOR EACH ROW begin
    select date_format(from_unixtime(new.created_at),'%y-%m-%d') into @update_date; 
    if new.cid <> '' && new.action <> 'topup' then
        update overview_daily set card_cost = card_cost + (new.real_pay - old.real_pay) where created_date = @update_date;
    elseif new.cid <> '' && new.action = 'topup' then
        update overview_daily set card_topup = card_topup + (new.real_pay - old.real_pay) where created_date = @update_date;
    else
        update overview_daily set non_card_cost = non_card_cost + (new.real_pay - old.real_pay) where created_date = @update_date;
    end if;
end
//
DELIMITER ;


DROP TRIGGER IF EXISTS `tg_i_on_member`;
DELIMITER //
CREATE TRIGGER `tg_i_on_member` AFTER INSERT ON `member`
 FOR EACH ROW begin
 select date_format(from_unixtime(new.created_at),'%y-%m-%d') into @insert_date;
 select count(*) from member into @total_mem_num;
    if not exists (select created_date from overview_daily where created_date = @insert_date) then
        insert into overview_daily(total_mem_num, new_mem_num, created_date, created_time) values(@total_mem_num, 1, @insert_date, unix_timestamp(@insert_date));
    else
        update overview_daily set total_mem_num = total_mem_num + 1 where created_date = @insert_date;
    end if;
end
//
DELIMITER ;