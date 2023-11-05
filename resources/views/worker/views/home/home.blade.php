<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('Ponuda') }}
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
      if(auth('worker')->check())
      {
        \App\Models\Tracker::hit();
      }
    @endphp
    <div class="slider">
        <div class="slide_viewer">
            <div class="slide_group">
                <div class="slide">
                <div class="darken-filter"></div>
                </div>
                <div class="slide">
                <div class="darken-filter"></div>
                </div>
                <div class="slide">
                <div class="darken-filter"></div>
                </div>
                <div class="slide">
                <div class="darken-filter"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="slide_buttons"></div>
    <style>
        .page-padding {
            padding: 0px !important;
            width: 100% !important;
            margin-top: -98px !important;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        $('.slider').each(function() {
      var $this = $(this);
      var $group = $this.find('.slide_group');
      var $slides = $this.find('.slide');
      var bulletArray = [];
      var currentIndex = 0;
      var timeout;
      
      function move(newIndex) {
        var animateLeft, slideLeft;
        
        advance();
        
        if ($group.is(':animated') || currentIndex === newIndex) {
          return;
        }
        
        bulletArray[currentIndex].removeClass('active');
        bulletArray[newIndex].addClass('active');
        
        if (newIndex > currentIndex) {
          slideLeft = '100%';
          animateLeft = '-100%';
        } else {
          slideLeft = '-100%';
          animateLeft = '100%';
        }
        
        $slides.eq(newIndex).css({
          display: 'block',
          left: slideLeft
        });
        $group.animate({
          left: animateLeft
        }, function() {
          $slides.eq(currentIndex).css({
            display: 'none'
          });
          $slides.eq(newIndex).css({
            left: 0
          });
          $group.css({
            left: 0
          });
          currentIndex = newIndex;
        });
      }
      
      function advance() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
          if (currentIndex < ($slides.length - 1)) {
            move(currentIndex + 1);
          } else {
            move(0);
          }
        }, 4000);
      }
      
      $('.next_btn').on('click', function() {
        if (currentIndex < ($slides.length - 1)) {
          move(currentIndex + 1);
        } else {
          move(0);
        }
      });
      
      $('.previous_btn').on('click', function() {
        if (currentIndex !== 0) {
          move(currentIndex - 1);
        } else {
          move(3);
        }
      });
      
      $.each($slides, function(index) {
        var $button = $('<a class="slide_btn">&bull;</a>');
        
        if (index === currentIndex) {
          $button.addClass('active');
        }
        $button.on('click', function() {
          move(index);
        }).appendTo('.slide_buttons');
        bulletArray.push($button);
      });
      
      advance();
    });
    </script>
</x-app-worker-layout>
