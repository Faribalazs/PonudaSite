@php
    $date = date("Y");
@endphp
<div class="footer-bg w-100">
    <div class="d-flex flex-row flex-wrap justify-content-around content-div">
        <div class="mt-4 links">
            <span class="footer-title">Információk</span>
            <div class="d-flex flex-column">
                <div class="pt-3"><a href="#" class="footer-category-text">Rólunk</a></div>
                <div class="pt-3"><a href="#" class="footer-category-text">Link1</a></div>
                <div class="pt-3"><a href="#" class="footer-category-text">Link2</a></div>
              </div>
        </div>
        <div class="mt-4 links">
            <span class="footer-title">Kapcsolatok</span>
            <div class="d-flex flex-column text-start mt-3">
                <div class="pt-1 d-flex media-text ">
                    <div class="d-flex align-items-center">
                        <i class="ri-phone-fill phone-icon"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="tel:+381 87 452 147" class="footer-category-text pl-3">+381 87 452 147</a>
                    </div>
                </div>
                <div class="pt-3 d-flex media-text">
                    <div class="d-flex align-items-center">
                        <i class="ri-mail-fill phone-icon"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="mailto:Ponuda@gmail.com" class="footer-category-text pl-3">Ponuda@gmail.com</a>
                    </div>
                </div>
              </div>
        </div>
        <div class="mt-4 pr-3">
            <span class="footer-title">Közösségi médiák</span>
            <div class="d-flex flex-column">
                <div class="pt-1 d-flex justify-content-between media-align">
                    <div class="d-flex align-items-center">
                        <i class="ri-facebook-circle-fill social-icon"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="ri-instagram-fill social-icon"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="ri-linkedin-box-fill social-icon"></i>
                    </div>
                </div>
              </div>
        </div>
    </div>
    <span class="copyright">Copyright © {{$date}} Farkas Balazs All Rights Reserved</span>
</div>
