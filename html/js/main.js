

$(window).load(function() {
  
  // Run the slider with fade effect
  $('.flexslider').flexslider({
    animation: "fade"
  });

  // random logos 1-3
  var images = ['logo1.png', 'logo2.png', 'logo3.png'];
  $('#logo').attr("src", 'images/' + images[Math.floor(Math.random() * images.length)]);


  $("li ul li").hide();
  $("ul.main-nav li").hover(
      function() {
          $("ul.main-nav li ul li", this).show();
      }, function() {
          $("ul.main-nav li ul li", this).hide();
      }
  );

});
