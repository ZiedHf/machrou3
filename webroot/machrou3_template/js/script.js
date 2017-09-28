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

    //For Materialize Alert 
    $('button.close').click(function(){
      if($(this).attr("data-dismiss") === 'alert'){
        $(this).parent().fadeOut( "slow", function(){});
      }
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
  });
}

function initializeConsultPage(){

}

function initializeCompaniesListPage(){
    $(document).ready(function(){
        tableSorterMaster();

    });
}

function initializeDepartementsListPage(){
    $(document).ready(function(){
        tableSorterMaster();

    });
}

function initializeConsultTeamsListPage(){
    $(document).ready(function(){
        tableSorterMaster();

    });
}

function lowerStrings(obj) {
  for (let attr in obj) {
    if (typeof obj[attr] === 'string') {
      obj[attr] = obj[attr].toLowerCase();
    } else if (typeof obj[attr] === 'object') {
      lowerStrings(obj[attr]);
    }
  }
  return obj;
}

function makeCustomSort(s, priorities){
  for (var attr in priorities) {
    s = s.toLowerCase().replace(priorities[attr], attr);
  }
  return s;
}

function initializeConsultViewListProjectPage(priorities, stages){
  headers = {
    2: {
      sorter:'priority'
    },
    3: {
      sorter:'stage'
    }
  };
  $(document).ready(function(){
      // add parser through the tablesorter addParser method
      priorities = lowerStrings(priorities);
      $.tablesorter.addParser({
        // set a unique id
        id: 'priority',
        is: function(s) {
          // return false so this parser is not auto detected
          return false;
        },
        format: function(s) {
          // format your data for normalization
          return makeCustomSort(s, priorities);
        },
        // set type, either numeric or text
        type: 'numeric'
      });

      stages = lowerStrings(stages);
      $.tablesorter.addParser({
        // set a unique id
        id: 'stage',
        is: function(s) {
          // return false so this parser is not auto detected
          return false;
        },
        format: function(s) {
          // format your data for normalization
          return makeCustomSort(s, stages);
        },
        // set type, either numeric or text
        type: 'numeric'
      });

      tableSorterMaster(headers);

  });
}
  function tableSorterMaster(headers = {}){
      $("table").tablesorter({
        theme : "materialize",

        widthFixed: true,
        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        widgets : [ "filter", "zebra" ],

        headers: headers,

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
  }
