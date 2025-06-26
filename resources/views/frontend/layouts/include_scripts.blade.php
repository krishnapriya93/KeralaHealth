
<!-- JS
    ============================================ -->
  <!-- jQuery JS -->
  <script  src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>


  <!-- Popper JS -->
  <script  src="{{asset('assets/frontend/js/popper.min.js')}}"></script>
  <!-- Bootstrap JS -->
  <script  src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
  <!-- jquery Waypoints JS -->
  <script  src="{{asset('assets/frontend/js/jquery.waypoints.min.js')}}"></script>
  <!-- jquery Appear JS -->
  <script  src="{{asset('assets/frontend/js/jquery.appear.js')}}"></script>
  <!-- Numinate JS -->
  <script  src="{{asset('assets/frontend/js/numinate.min.js')}}"></script>
  <!-- Slick JS -->
  <script  src="{{asset('assets/frontend/js/swiper.min.js')}}"></script>
  <!-- Magnific JS -->
  <script  src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
  <!-- Circle Progress JS -->
  <script  src="{{asset('assets/frontend/js/circle-progress.js')}}"></script>
  <!-- countdown JS -->
  <script  src="{{asset('assets/frontend/js/jquery.countdown.min.js')}}"></script>
  <!-- AOS -->
  <script  src="{{asset('assets/frontend/js/aos.js')}}"></script>
  <!-- GSAP -->
  <script  src="{{asset('assets/frontend/js/gsap.js')}}"></script>
  <!-- Scroll Trigger -->
  <script  src="{{asset('assets/frontend/js/ScrollTrigger.js')}}"></script>
  <!-- Split Text -->
  <script  src="{{asset('assets/frontend/js/SplitText.js')}}"></script>
  <!-- Magnetic -->
  <script  src="{{asset('assets/frontend/js/magnetic.js')}}"></script>
  <!-- GSAP Animation -->
  <script  src="{{asset('assets/frontend/js/gsap-animation.js')}}"></script>
  <!-- Scripts JS -->
  <script  src="{{asset('assets/frontend/js/jQuery.scrollText.js')}}"></script>
  <script  src="{{asset('assets/frontend/js/main.js')}}"></script>
  <script  src="{{asset('assets/frontend/js/newsTicker.js')}}"></script>
  <script  src="{{asset('assets/frontend/js/scripts.js')}}"></script>

  

 <script>
  
$('.newsticker').newsTicker({

speed: 700,
direction: 'up',
row_height: 70,
duration: 3000,
autostart: 1,
pauseOnHover: 1
});

 </script>
 <script>
  $('.languageButton').on('click', function() {
    // Toggle text between English and Malayalam
   // Get the current text of the button and trim any whitespace
   const currentText = $(this).text().trim();
   var newValue = $(this).val();
// alert(newValue);
    if (newValue == 1) {
            $.ajax({
                url: "/setbilingualval",
                dataType: "json",
                success: function (data) {
                    window.location.reload();

                }
            })
        } else {
            $.ajax({
                url: "/setbilingualvalmal",
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                }
            })
        }

});
</script>