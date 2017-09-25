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
