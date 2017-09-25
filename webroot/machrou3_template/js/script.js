var CycleInSec;
var autoplay_id;
function startAutoplay($carousel) {
   CycleInSec = 5000;
   autoplay_id = setInterval(function() {
      $('.carousel').carousel('next');
    }, CycleInSec); // every 5 seconds
  //console.log("starting autoplay");
}

function stopAutoplay() {
  if(autoplay_id) {
    clearInterval(autoplay_id);
    //console.log("stoping autoplay");
  }
}

$( document ).ready(function(){
    $(".dropdown-button").dropdown({
      constrainWidth: false, // Does not change width of dropdown to that of the activator
    });

    $(".button-collapse").sideNav();

    $("#second-nav .nav-wrapper div.row div.col.hide-on-small-only a").sideNav({
      menuWidth:350,
      constrainWidth: false,
      edge : 'right'
    });
})

function initializeLoginPage(){
  $(document).ready(function(){
      $("#menu").click(function(){
        if($('.tap-target-wrapper').hasClass("open")){
          $('.tap-target').tapTarget('close');
        }else {
          $('.tap-target').tapTarget('open');
        };
      });

      $('.carousel.carousel-slider').mouseover(function() {
        stopAutoplay();
      });
      $('.carousel.carousel-slider').mouseleave(function() {
        stopAutoplay();
        startAutoplay();
      });

      $('.waves-effect.waves-light.btn').sideNav();

      $('.carousel.carousel-slider').carousel({
                                                duration:300,
                                                indicators:true,
                                                onCycleTo : function($current_item, dragged) {
                                                  //console.log($current_item);
                                                  stopAutoplay();
                                                  startAutoplay($('.carousel'));
                                                }});
      $('button.close').click(function(){
        if($(this).attr("data-dismiss") === 'alert'){
          $(this).parent().fadeOut( "slow", function(){});
        }
      });
  });
}

function initializeConsultPage(){

}

function initializeCompaniesListPage(){
    $(document).ready(function(){
        //add_dataTable('#companiesTable', '../','webroot/js/datatables/fr_FR.json');

        $(function() {

          $("table").tablesorter({
            theme : "materialize",

            widthFixed: true,
            // widget code contained in the jquery.tablesorter.widgets.js file
            // use the zebra stripe widget if you plan on hiding any rows (filter widget)
            widgets : [ "filter", "zebra" ],

            widgetOptions : {
              // using the default zebra striping class name, so it actually isn't included in the theme variable above
              // this is ONLY needed for materialize theming if you are using the filter widget, because rows are hidden
              zebra : ["even", "odd"],

              // reset filters button
              filter_reset : ".reset"
            }
          })
          .tablesorterPager({

            // target the pager markup - see the HTML block below
            container: $(".ts-pager"),

            // target the pager page select dropdown - choose a page
            cssGoto  : ".pagenum",

            // remove rows from the table to speed up the sort of large tables.
            // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
            removeRows: false,

            // output string - default is '{page}/{totalPages}';
            // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
            output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

          });

        });
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
