@extends('base')

@section('sidebar')
@include('layout.sidebar')
@endsection

@section('breadcrumbs')
@include('_partials.breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('showchart')])
@endsection

@section('css')
<link rel="stylesheet" href="/css/datepicker.css" />
<link rel="stylesheet" href="/css/ui.jqgrid.css" />
@endsection

@section('content')
<div id="grid-pager"></div>
<table id="grid-table"></table>

@endsection

@section('script')
<script src="/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="/js/jqGrid/jquery.jqGrid.min.js"></script>
<script src="/js/jqGrid/i18n/grid.locale-cn.js"></script>
<script type="text/javascript">

jQuery(function($) {
    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";

    jQuery(grid_selector).jqGrid({
        //direction: "rtl",
        
        url: "/customsetting/create",
        editurl: "/customsetting/store",
        datatype: "json",
        height: 300,
        colNames:[' ', '', '属性组名称','属性名称','属性值', '门店'],
        colModel:[
            {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,
                formatter:'actions', 
                formatoptions:{ 
                    keys:true,
                    
                    delOptions:{recreateForm: true, beforeShowForm : deleteBeforeShowForm, onclickSubmit: deleteSubmit},
                    //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
                }
            },
            {name:'id',index:'id', hidden: true},
            {name:'attrgroup',index:'attrgroup', editrules:{required:true}, width:60, editable: true},
            {name:'attrname',index:'attrname',width:60, editrules:{required:true}, editable:true},
            {name:'attrvalue',index:'attrvalue', width:60, editable: true},
            {name:'store',index:'store', width:70, editable: true}
        ], 

        viewrecords: true,
        rowNum:10,
        rowList:[10,20,30],
        pager : pager_selector,
        altRows: true,
        //toppager: true,
        
        multiselect: true,
        //multikey: "ctrlKey",
        multiboxonly: true,

        loadComplete: function() {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
                enableTooltips(table);
            }, 0);
        },

        //editurl: $path_base+"/dummy.html",//nothing is saved
        caption: "用户自定义属性",
        autowidth: true

    });

    //enable search/filter toolbar
    //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})

    //navButtons
    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
        {   //navbar options
            edit: true,
            editicon : 'icon-pencil blue',
            add: true,
            addicon : 'icon-plus-sign purple',
            del: true,
            delicon : 'icon-trash red',
        },
        {
            //edit record form
            //closeAfterEdit: true,
            recreateForm: true,
            beforeShowForm : function(e) {
                $('#tr_attrgroup', e).hide();
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            }
        },
        {
            //new record form
            closeAfterAdd: true,
            recreateForm: true,
            viewPagerButtons: false,
            beforeShowForm: function(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            },
            onclickSubmit: function(params, posdata) { 
                posdata['_token'] = "{{ csrf_token() }}";
                console.log(posdata);
                return posdata
            }
        },
        {
            //delete record form
            recreateForm: true,
            beforeShowForm : deleteBeforeShowForm,
            onclickSubmit : deleteSubmit
        }
    );
    function deleteBeforeShowForm (e) {
        var form = $(e[0]);
        if(form.data('styled')) return false;
        
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);
        
        form.data('styled', true);
    }

    function deleteSubmit (params, posdata) {
        params.url = "/customsetting/" + posdata;
        data = new Array();
        data['_token'] = "{{ csrf_token() }}";
        data['_method'] = "DELETE";
        return data;
    }


    
    function style_edit_form(form) {
        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="icon-ok"></i>');
        buttons.eq(1).prepend('<i class="icon-remove"></i>')
        
        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').remove();
        buttons.eq(0).append('<i class="icon-chevron-left"></i>');
        buttons.eq(1).append('<i class="icon-chevron-right"></i>');     
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="icon-trash"></i>');
        buttons.eq(1).prepend('<i class="icon-remove"></i>')
    }
    
    function beforeDeleteCallback(e) {
        var form = $(e[0]);
        if(form.data('styled')) return false;
        
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);
        
        form.data('styled', true);
    }
    
    function beforeEditCallback(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
    }
    
    //replace icons with FontAwesome icons like above
    function updatePagerIcons(table) {
        var replacement = 
        {
            'ui-icon-seek-first' : 'icon-double-angle-left bigger-140',
            'ui-icon-seek-prev' : 'icon-angle-left bigger-140',
            'ui-icon-seek-next' : 'icon-angle-right bigger-140',
            'ui-icon-seek-end' : 'icon-double-angle-right bigger-140'
        };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
            
            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
        })
    }

    function enableTooltips(table) {
        $('.navtable .ui-pg-button').tooltip({container:'body'});
        $(table).find('.ui-pg-div').tooltip({container:'body'});
    }

    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');


});

</script>
@endsection