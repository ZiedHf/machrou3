/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*showThumbs: true,
		addMore: true,
		allowDuplicates: false*/
function uploadFiles(id, extensions, limit){
    $('#'+id).filer({
		limit: limit,
		maxSize: 20,
		extensions: extensions,
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			removeConfirmation: "Are you sure you want to remove this file?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	}); 
}

function initializeConsultPage(){
    
    /*$(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenue à l\'application gestion des projets !',
            // (string | mandatory) the text inside the notification
            text: 'Vous trouvrez dans cette application les projets des départements et leurs détails. <br> Version : 1.0.0 <a href="http://blacktie.co" target="_blank" style="color:#ffd777">khidma.tn</a>.',
            // (string | optional) the image to display on the left
            image: './dashgumfree/assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
    });*/
        
    $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
            /*$("#my-calendar").zabuto_calendar({
                language: "fr",
                today: true,
                nav_icon: {
                  prev: '<i class="fa fa-chevron-circle-left"></i>',
                  next: '<i class="fa fa-chevron-circle-right"></i>'
                },
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                /*ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },*/
                /*legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });*/
        }); 
        //console.log(info_charts);
        for(var k in info_charts) {
            chart_view(info_charts[k]['departement'], info_charts[k]['projects']);
            //console.log(info_charts[k]['projects']);
        }
}


function chart_view(departement, projects){
    /*Charts*/
            //morris chart
            
              // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
              
                //console.log(k, result[k]['departement']);
              Morris.Bar({
                element: departement,
                data: projects,
                xkey: 'projet',
                ykeys: ['accomplishment'],
                labels: ['Achèvement'],
                barRatio: 0.4,
                xLabelAngle: 0,
                hideHover: 'auto',
                barColors: ['#0ff153'],
                ymax: 100,
                resize: true                
              });

              $('.code-example').each(function (index, el) {
                eval($(el).text());
              });

}
function initializeConsultViewDepartementPage(priorities, stages){
    
    $(document).ready(function(){
        add_dataTable("table[data-products*='projectsTable']", '../../','webroot/js/datatables/fr_FR.json', priorities, stages);
        
        $('[data-toggle="popover"]').popover();
    });
}

function initializeConsultViewListProjectPage(priorities, stages){
    $(document).ready(function(){
        add_dataTable("table[data-products*='projectsTable']", '../','webroot/js/datatables/fr_FR.json', priorities, stages);
        /*$('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column( $(this).attr('data-column') );

            // Toggle the visibility
            column.visible( ! column.visible() );
        } );*/
        $('[data-toggle="popover"]').popover();
    });
}
function initializeConsultEmployeesListPage(){
    $(document).ready(function(){
        add_dataTable("#employeesTable", '../','webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultClientsListPage(){
    $(document).ready(function(){
        add_dataTable("#clientsTable", '../','webroot/js/datatables/fr_FR.json');
    });
}

function initializeCompaniesListPage(){
    $(document).ready(function(){
        add_dataTable('#companiesTable', '../','webroot/js/datatables/fr_FR.json');
    });
}

function initializeDepartementsListPage(){
    $(document).ready(function(){
        add_dataTable('#departementsTable', '../','webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultViewUserPage(pageName){
    $(document).ready(function(){
        if(pageName == 'ViewUserInfo'){
            parent_url = '../../';
        }else{//ViewUserInfo
            parent_url = '../../../';
        }
        add_dataTable('#projectsTable', parent_url,'webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultViewClientPage(){
    $(document).ready(function(){
        add_dataTable('#projectsTable', '../../','webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultViewTeamPage(){
    $(document).ready(function(){
        add_dataTable('#projectsTable', '../../../','webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultViewTeamInfoPage(){
    $(document).ready(function(){
        add_dataTable('#projectsTable', '../../','webroot/js/datatables/fr_FR.json');
    });
}
function initializeConsultTeamsListPage(){
    $(document).ready(function(){
        add_dataTable('#teamsTable', '../','webroot/js/datatables/fr_FR.json');
    });
}

function add_dataTable(str, parent,url, priorities, stages){
    var window_width = window.innerWidth;
    
    if(str === "table[data-products*='projectsTable']"){
        if(priorities !== undefined){
            $.fn.dataTable.enum( from_objToArray(priorities) );
        }
        if(stages !== undefined){
            $.fn.dataTable.enum( from_objToArray(stages) );
        }
        //console.log([ 'Important', 'Moyen', 'Faible' ]);
        data = {
            language: { url : parent+url},
            "autoWidth": false
        };
    }else{
        data = {
            responsive: true,
            language: { url : parent+url}
        };
    }
    
    if(window_width < 500) { 
        //width_x = {"scrollX": true};
        data.scrollX = true;
    }
    //Tri selon l'ordre des : priorités et étapes
    //$.fn.dataTable.enum( [ 'Important', 'Moyen', 'Faible' ] );
    var table = $(str).DataTable(data);
}


function initializeConsultViewProjectPage(){
    $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });
      /*$(function(){
          $("select.styled").customSelect();
      });*/
}
function initializeConsultViewProjectInfoPage(){
    $(function() {
          jQuery(".fancybox").fancybox();
      });
}
function myDateFunction(id) {
    var date = $("#" + id).data("date");
    var hasEvent = $("#" + id).data("hasEvent");
    //console.log('date ' + date + ' hasEvent: ' + hasEvent);
}
function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    //console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}

function parcour_checkbox(){
    $("input[type='checkbox']").each(function(i){
        if($(this).is(':checked')){
            $(this).parent().parent('.hidden').removeClass('hidden');
            $(this).parent('td').next().children('input').prop("disabled", false);
            //alert($(this).val());
        }
    });
}

function uncheckallCheckbox(){
    $("input[type='checkbox']").each(function(i, selected){
        input_checkbox = $(this);
        input_checkbox.prop("checked", false);
        input_text = $("[name*='time-dedicated']");
        input_text.prop("disabled", true).val('');
        //console.log(i);
    });
    $("tr[id*='tr-']").each(function(){
            $(this).addClass('hidden'); 
    });
}

function parcour_select(usersbyteam){
    uncheckallCheckbox();
    $('#teams-ids option:selected').each(function(i, selected){ 
        idTeam = $(this).val();
        //console.log(idTeam);

        for (index = 0; index < usersbyteam[idTeam].length; ++index) {
            id_employee = usersbyteam[idTeam][index];
            $("#tr-"+id_employee).removeClass('hidden');
            input_checkbox = $("input[type='checkbox'][data-employee="+id_employee+"]");
            input_text = $("[data-time-dedicated='"+id_employee+"']");
            input_radio = $("#chefproject-"+id_employee);
            if(input_checkbox.is(':checked')){
                //input_checkbox.prop("checked", false);
                //input_text.prop("disabled", true).val('');
            }else{
                input_checkbox.prop("checked", true);
                input_text.prop("disabled", false);
                input_radio.prop("disabled", false);
            }
        }
    });
}

function warningNoemployees(){
    if($('#teams-ids').val()){
            $('#warning-noemployees').addClass('hidden');
            $('#employees_table').removeClass('hidden');
        }else{
            uncheckallCheckbox();
            $('#warning-noemployees').removeClass('hidden');
            $('#employees_table').addClass('hidden');
        }
}

function employeesMatchTeams(usersbyteam){
    // Si l'utilisateur choisi une équipe on doit cocher automatiquement les employées
    //Décocher tous les utilisateur s'il change 
    $("#teams-ids").change(function(){
        parcour_select(usersbyteam);
        warningNoemployees();
    });
    // Si l'utilisateur choisi manuellement
    $( "input[type='checkbox']" ).click(function() {
        if($(this).is(':checked')){
            $("[data-time-dedicated="+$(this).val()+"]").prop("disabled", false);
            $("#chefproject-"+$(this).val()).prop("disabled", false);
            //console.log($(this).val());
        }else{//Après chaque deselection cette fonction vérifie les équipes s'ils ont des membres selectiones
            $("[data-time-dedicated="+$(this).val()+"]").prop("disabled", true).val('');
            $("#chefproject-"+$(this).val()).prop("disabled", true).prop('checked', false);
            $('#teams-ids option:selected').each(function(i, selected){
                idTeam = $(this).val();
                employees_exist = false;
                index = 0;
                while((!employees_exist)&&(index < usersbyteam[idTeam].length)){
                    id_employee = usersbyteam[idTeam][index];
                    input_checkbox = $("input[type='checkbox'][data-employee="+id_employee+"]");
                    if(input_checkbox.is(':checked')){employees_exist = true;}
                    ++index;
                }
                if(!employees_exist) {
                    $(this).prop('selected', false);
                    for (index = 0; index < usersbyteam[idTeam].length; ++index) {
                        input_checkbox = $("input[type='checkbox'][data-employee="+usersbyteam[idTeam][index]+"]");
                        $("tr[id*='tr-"+usersbyteam[idTeam][index]+"']").addClass('hidden');
                    }
                }
            });
        }
        warningNoemployees();
    });
}
function calendar_fieldsinputs(type){
    var firstOpenBg = true;
    var firstOpenEnd = true;
    //var today = new Date();
    
    $('#datetimepickerBg').datetimepicker({
        useCurrent: false,
        locale: 'fr',
        daysOfWeekDisabled: [0],
        showTodayButton:true,
        showClear:true,
        showClose:true,
        enabledHours:['8','9','10','11','12','13','14','15','16','17'],
        viewMode:'months',
        allowInputToggle: true
    }).on("dp.show", function(){
        if (firstOpenBg===true){
            $(this).data('DateTimePicker').date(new Date(new Date().setHours(08, 00)));
            firstOpenBg=false;
        }
    });
    $('#datetimepickerEnd').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        locale: 'fr',
        daysOfWeekDisabled: [0],
        showTodayButton:true,
        showClear:true,
        showClose:true,
        enabledHours:['8','9','10','11','12','13','14','15','16','17'],
        viewMode:'months',
        allowInputToggle: true
    }).on("dp.show", function(){
        if (firstOpenEnd===true){
            $(this).data('DateTimePicker').date(new Date(new Date().setHours(18, 00)));
            firstOpenEnd=false;
        }
    });
    
    //$("#datetimepickerBg").data('DateTimePicker').date(new Date(new Date().setHours(08, 00)));
    $("#datetimepickerBg").on("dp.change", function (e) {
        $('#datetimepickerEnd').data("DateTimePicker").minDate(e.date);
        //$(this).data('DateTimePicker').date(new Date(new Date().setHours(18, 00)));
        /*if(test === false){
            test = true;
            $("#datetimepickerBg").data('DateTimePicker').date(new Date(new Date().setHours(18, 00)));
        }*/
    });
    $("#datetimepickerEnd").on("dp.change", function (e) {
        $('#datetimepickerBg').data("DateTimePicker").maxDate(e.date);
    });
    
    if(type === 'edit'){//only edit page
        if($('#datetimepickerEnd').data("DateTimePicker").date() !== null){
            $('#datetimepickerBg').data("DateTimePicker").maxDate($('#datetimepickerEnd').data("DateTimePicker").date());
        }
        if($('#datetimepickerBg').data("DateTimePicker").date() !== null){
            $('#datetimepickerEnd').data("DateTimePicker").minDate($('#datetimepickerBg').data("DateTimePicker").date());
        }
    }
}

function checkbox_errorhandle(usersbyteam){
    //S'il y a des checkBox selectionné ne fait rien
    checkboxChecked = false;
    $("input[type='checkbox']").each(function(i, selected){
        input_checkbox = $(this);
        if(input_checkbox.is(':checked')){
            checkboxChecked = true;
        }
    });
    if(!checkboxChecked){
        $('#teams-ids option:selected').each(function(i, selected){ 
            idTeam = $(this).val();
            //console.log(idTeam);
            for (index = 0; index < usersbyteam[idTeam].length; ++index) {
                id_employee = usersbyteam[idTeam][index];
                $("#tr-"+id_employee).removeClass('hidden');
                input_checkbox = $("input[type='checkbox'][data-employee="+id_employee+"]");
                input_text = $("[data-time-dedicated='"+id_employee+"']");
                if(input_checkbox.is(':checked')){
                    //input_checkbox.prop("checked", false);
                    //input_text.prop("disabled", true).val('');
                }else{
                    input_checkbox.prop("checked", true);
                    input_text.prop("disabled", false);
                }
            }
        });
    }
    //Si on a pas des teams selectionnées le warning no employees s'apparait
    warningNoemployees();
}

function initializeAddProjectPage(usersbyteam){
    $(document).ready(function() {
        //En cas d'erreur, selectioner les membres des équipes séléctionnées 
        checkbox_errorhandle(usersbyteam);
        //Le reste du procédure
        employeesMatchTeams(usersbyteam);
        //Si on a pas des teams selectionnées le warning no employees s'apparait
        warningNoemployees();
        uploadFiles('filer_input', null, null);    
        //$('#timepickertest').datetimepicker();
        //$('#timepickertest').data("DateTimePicker");
        calendar_fieldsinputs('add');
        
        $('#myTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
          
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
    });
}

function initializeEditProjectPage(usersbyteam, DOSSIER_RACINE){
    $(document).ready(function() {
        //En cas d'erreur, selectioner les membres des équipes séléctionnées 
        checkbox_errorhandle(usersbyteam);
        //suite
        parcour_checkbox();
        employeesMatchTeams(usersbyteam);
        //Si on a pas des teams selectionnées le warning no employees s'apparait
        warningNoemployees();
        uploadFiles('filer_input', null, null);  
        calendar_fieldsinputs('edit');
        
        //Afficher les autres membres des équipes selectionnées
        $('#autreEmployees').click(function(){
            $('#teams-ids option:selected').each(function(i, selected){ 
                idTeam = $(this).val();
                for (index = 0; index < usersbyteam[idTeam].length; ++index) {
                    id_employee = usersbyteam[idTeam][index];
                    $("#tr-"+id_employee).removeClass('hidden');
                    input_checkbox = $("input[type='checkbox'][data-employee="+id_employee+"]");
                    if(!(input_checkbox.is(':checked'))){
                        $("#chefproject-"+id_employee).prop("disabled", true);
                    }
                }
            });
        });
        
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
        
        //DELETE FILES
        $('[id*="delete-file-"]').click(function() {
            //console.log($('#path_dir').val());
            //console.log($(this).attr('id'));
            id_file_delete = $(this).attr('id');
            $.ajax({
                type:"POST",
                url: "/"+DOSSIER_RACINE+"/projects/deletefile/"+$('#path_dir').val()+"/"+$(this).attr('data-file')+"/",
                dataType: 'html',
                async:false,
                success: function(response){
                    $('#'+id_file_delete).parent().parent().parent().parent().html(response); 
                    //$("#responsecontainer").html(response); 
                },
                error: function () {
                    alert('error');
                }
           });
       });
    });
}
function rangefunction(id){
    $(id).asRange({

            // namespace
            namespace: 'asRange',

            // requires additional skin file
            skin: null,

            // max value
            max: 100,

            // min value
            min: 0,

            // initial value
            value: null,

            // moving step at a time
            step: 1,

            // limit the range of the pointer moving
            limit: true,

            // initial range
            range: false,

            // 'v' or 'h'
            direction: 'h', 

            // enable keyboard interactions
            keyboard: true,

            // false, 'inherit', {'inherit': 'default'}
            replaceFirst: false, 

            // shows tips
            tip: true,

            // shows scales
            scale: true,

            // for formatting output
            format: function format(value) {
              return value;
            }

        });
}

function initializeAddUserPage(){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1);  
        
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
    });
}
function initializeEditUserPage(DOSSIER_RACINE){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1); 
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
        //DELETE FILES
        $('[id*="delete-file-"]').click(function() {
            $('div#imageInput').removeClass('hidden');
            //console.log($(this).attr('id'));
            id_file_delete = $(this).attr('id');
            $.ajax({
                type:"POST",
                url: "/"+DOSSIER_RACINE+"/users/deletefile/"+$('#path_dir').val()+"/"+$(this).attr('data-file')+"/",
                dataType: 'html',
                async:false,
                success: function(response){
                    $('#'+id_file_delete).parent().parent().parent().parent().html(response); 
                    //$("#responsecontainer").html(response); 
                },
                error: function () {
                    alert('error');
                }
           });
       });
    });
}
function initializeAddClientPage(){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1);      
    });
}
function initializeEditClientPage(){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1);      
    });
}

function initializeAddTeamPage(){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1); 
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
    });
}
function initializeEditTeamPage(DOSSIER_RACINE){
    $(document).ready(function() {
        uploadFiles('filer_input', ["jpg", "jpeg", "png", "gif"], 1); 
        $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
        });
        //DELETE FILES
        $('[id*="delete-file-"]').click(function() {
            $('div#imageInput').removeClass('hidden');
            //console.log($(this).attr('id'));
            id_file_delete = $(this).attr('id');
            $.ajax({
                type:"POST",
                url: "/"+DOSSIER_RACINE+"/teams/deletefile/"+$('#path_dir').val()+"/"+$(this).attr('data-file')+"/",
                dataType: 'html',
                async:false,
                success: function(response){
                    $('#'+id_file_delete).parent().parent().parent().parent().html(response); 
                    //$("#responsecontainer").html(response); 
                },
                error: function () {
                    alert('error');
                }
           });
       });
    });
}

function initializeIndexUserPage(){
    $(document).ready(function() {
        recherche_collapse();
    });
}
function initializeIndexTeamPage(){
    $(document).ready(function() {
        recherche_collapse();
    });
}
function initializeIndexProjectPage(){
    $(document).ready(function() {
        recherche_collapse();
    });
}

function initializeIndexClientPage(){
    $(document).ready(function() {
        recherche_collapse();
    });
}
function initializeIndexDepartementPage(){
    $(document).ready(function() {
        recherche_collapse();
    });
}

function recherche_collapse(){
    $('[id*="id_search"]').each(function(){
        if($(this).val().length > 0){
            $('#search').prop('aria-expanded', true).addClass('in');
            $("button[data-toggle='collapse']").children('i').removeClass('fa-plus-square').addClass('fa-minus-square');
        }
    });
    $('[id*="id_select"]').each(function(){
        if($(this).val() != ''){
            $('#search').prop('aria-expanded', true).addClass('in');
            $("button[data-toggle='collapse']").children('i').removeClass('fa-plus-square').addClass('fa-minus-square');
        }
    });
    
    $("button[data-toggle='collapse']").click(function(){
        if($('#search').is('.in')){
            $(this).children('i').removeClass('fa-minus-square').addClass('fa-plus-square');
        }else{
            $(this).children('i').removeClass('fa-plus-square').addClass('fa-minus-square');
        }
    });
}

function initializeConsultCalendar(projects){
    //FullCalendar
    $(document).ready(function() {
		$('#calendar').fullCalendar({
                        theme:true,
                        locale: 'fr',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listMonth'
			},
                        displayEventTime: false,
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: projects
		});
		
	});
}

function initializeAddDepartementPage(){
    $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
    });
}
function initializeEditDepartementPage(){
    $('[id*="rangeinput"]').each(function(){
            id = $(this).attr('id');
            rangefunction('#'+id);
    });
}

function from_objToArray(myObj){
    var array = $.map(myObj, function(value, index) {
        return [value];
    });
    return array;
}




