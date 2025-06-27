@extends('frontend.layouts.main_header')

@section('content')


    <!-- page wrapper -->
    <div class="page-wrapper pbmit-bg-color-light">
      
        <!-- Header Main Area -->
        @include('frontend.layouts.main_menu')
        <!-- Header Main Area End Here -->
        	<!-- Title Bar -->
            <div class="pbmit-title-bar-wrapper">
                <div class="container">
                    <div class="pbmit-title-bar-content">
                        <div class="pbmit-title-bar-content-inner">
                            <div class="pbmit-tbar">
                                <div class="pbmit-tbar-inner container">
                                    <h1 class="pbmit-tbar-title">Sustainable Development Goals</h1>
                                </div>
                            </div>
                            <!-- <div class="pbmit-breadcrumb">
                                <div class="pbmit-breadcrumb-inner">
                                    <span>
                                        <a title="" href="#" class="home"><span>Xcare</span></a>
                                    </span>
                                    <span class="sep">
                                        <i class="pbmit-base-icon-angle-double-right"></i>
                                    </span>
                                    <span><span class="post-root post post-post current-item">Dentist</span></span>
                                    <span class="sep">
                                        <i class="pbmit-base-icon-angle-double-right"></i>
                                    </span>
                                    <span><span class="post-root post post-post current-item"> The Most important Ventilator Equipment available</span></span>
                                </div>
                            </div> -->
                        </div>
                    </div> 
                </div> 
            </div>
            <!-- Title Bar End-->
        <!-- page content -->
        <div class="page-content">

            <section class="site_content blog-details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 blog-right-col">
                                    <article class="main-article">
                                        <div class="pbmit-animation-style1">
                                            <img src="{{asset('assets/frontend/images/sdg1.jpg') }}" class="img-fluid w-100" alt="">
                                        </div>
                                        <div class="post blog-classic">
                                            <div class="pbmit-blog-classic-inner sdg-h">
                                                <div class="pbmit-entry-content">
                                                    <p class="pbmit-firstletter">The Sustainable Development Goals (SDGs) are a set of 17 global objectives established by the United Nations in 2015 as part of the 2030 Agenda for Sustainable Development. These goals aim to address the world's most pressing challenges, including poverty, inequality, climate change, environmental degradation, peace, and justice. They are designed to achieve a better and more sustainable future for all, balancing social, economic, and environmental dimensions of development.</p>
                                                    <p >Sustainable Development Goals (SDGs) are a set of 17 global objectives established by the United Nations in 2015 as part of the 2030 Agenda for Sustainable Development. They aim to address a wide range of global challenges, including poverty, inequality, climate change, environmental degradation, peace, and justice. Each goal has specific targets, and they are interconnected, recognizing that actions in one area will affect outcomes in others.</p>
                                                    <div class="project-single-img_box" id="sdg3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style">
                                                                    <img src="{{asset('assets/frontend/images/sdg3.svg') }}" class="img-fluid rounded-0" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-md-6 mb-4 ">
                                                            <h5 class="mb-1 pbmit-title">1. Universal Health Coverage</h5>
                                                            <ul class="list-group list-group-borderless ">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                       <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Access to Healthcare for All </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Health Insurance Schemes (e.g., Ayushman Bharat)</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Public and Private Healthcare Infrastructure</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Primary Health Centers and Telemedicine Services</span>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">2. Maternal and Child Health</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Maternal Mortality Rate (MMR) Reduction Programs </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Child Immunization and Healthcare Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Antenatal and Postnatal Care Services</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Infant Mortality Rate (IMR) and Neonatal Care</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">3. Communicable Diseases Control</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Eradication of Infectious Diseases (e.g., Tuberculosis, Malaria) </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">HIV/AIDS Awareness and Prevention Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Immunization Campaigns (e.g., Polio, Measles) </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Public Health Initiatives on Epidemics (COVID-19 Response)</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">4. Non-Communicable Diseases (NCDs)</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Cancer Prevention and Treatment Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Diabetes and Cardiovascular Disease Control</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Mental Health Awareness and Services</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Tobacco and Substance Abuse Prevention</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Lifestyle and Wellness Initiatives (Healthy Kerala)</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">5. Reproductive and Sexual Health</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Family Planning and Contraceptive Use</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Adolescent and Sexual Health Education</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Fertility Care and Assisted Reproductive Services</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Preventive Measures for Sexually Transmitted Infections (STIs)</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">6. Mental Health and Well-being</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Mental Health Counseling and Support Services</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Public Awareness on Mental Health Issues</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Programs on Depression, Anxiety, and Suicide Prevention</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Integration of Mental Health into Primary Care</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">7. Health Promotion and Disease Prevention</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Health Education Campaigns</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Nutrition and Healthy Diet Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Physical Activity and Exercise Initiatives</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Anti-Tobacco and Alcohol Awareness Campaigns</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <h5 class="mb-1 pbmit-title">8. Access to Medicines and Vaccine</h5>
                                                            <ul class="list-group list-group-borderless">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Affordable Essential Medicines and Vaccines</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Promotion of Generic Drugs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Local Production of Medicines</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Immunization Schedules and Availability</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- ------------------------------------------------------------------ -->
                                                    <div class="project-single-img_box" id="sdg6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style">
                                                                    <img src="{{asset('assets/frontend/images/sdg6.svg') }}" class="img-fluid rounded-0" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="row">
                                                    <div class="col-md-6 mb-4 ">
                                                        <h5 class="mb-1 pbmit-title">1. Access to Clean Drinking Water</h5>
                                                        <ul class="list-group list-group-borderless ">
                                                            <li class="list-group-item">
                                                                <span class="pbmit-icon-list-icon">
                                                                   <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                </span>
                                                                <span class="pbmit-icon-list-text">Safe Drinking Water Initiatives in Rural and Urban Areas</span>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="pbmit-icon-list-icon">
                                                                    <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                </span>
                                                                <span class="pbmit-icon-list-text">Water Quality Monitoring Programs</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6 mb-4 ">
                                                        <h5 class="mb-1 pbmit-title">2. Sanitation and Hygiene</h5>
                                                        <ul class="list-group list-group-borderless ">
                                                            <li class="list-group-item">
                                                                <span class="pbmit-icon-list-icon">
                                                                    <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                </span>
                                                                <span class="pbmit-icon-list-text">Sanitation Coverage and Open Defecation Free (ODF) Programs</span>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="pbmit-icon-list-icon">
                                                                    <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                </span>
                                                                <span class="pbmit-icon-list-text">Hygiene Awareness and Handwashing Campaigns</span>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="pbmit-icon-list-icon">
                                                                    <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                </span>
                                                                <span class="pbmit-icon-list-text">Waste Management and Health Impact</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                   </div>
                                                    <!-- ---------------------------------------------------------------------------------------------- -->
                                                    <div class="project-single-img_box" id="sdg2">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style">
                                                                    <img src="{{asset('assets/frontend/images/sdg2.svg') }}" class="img-fluid rounded-0" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 ">
                                                            <h5 class="mb-1 pbmit-title">1. Nutrition and Malnutrition Prevention</h5>
                                                            <ul class="list-group list-group-borderless ">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                       <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Child Nutrition and Malnutrition Eradication Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Midday Meal Scheme and Nutritional Supplements</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Food Security Initiatives in Vulnerable Communities</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4 ">
                                                            <h5 class="mb-1 pbmit-title">2. Maternal and Child Nutrition</h5>
                                                            <ul class="list-group list-group-borderless ">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                       <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Breastfeeding Promotion Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Nutrition for Pregnant and Lactating Women</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Community Health Workers and Nutrition Awareness</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- -------------------------------------------------------------------------------------- -->
                                                    <div class="project-single-img_box" id="sdg5">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style">
                                                                    <img src="{{asset('assets/frontend/images/sdg5.svg') }}" class="img-fluid rounded-0" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-4 ">
                                                            <h5 class="mb-1 pbmit-title">1. Women’s Health Initiatives</h5>
                                                            <ul class="list-group list-group-borderless ">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                       <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Reproductive Health Services for Women</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Maternal Healthcare and Safe Motherhood Programs</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Addressing Gender-Based Health Disparities</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 mb-4 ">
                                                            <h5 class="mb-1 pbmit-title">2. Healthcare Access for Marginalized Women</h5>
                                                            <ul class="list-group list-group-borderless ">
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                       <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Health Services for Women in Rural and Tribal Areas</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <span class="pbmit-icon-list-icon">
                                                                        <img src="{{asset('assets/frontend/images/next.png') }}" alt="" class="me-2">
                                                                    </span>
                                                                    <span class="pbmit-icon-list-text">Health Programs for Women with Disabilities</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- ------------------------------------------------------------------------ -->
                                                    <div class="project-single-img_box" id="sdg13">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style">
                                                                    <img src="{{asset('assets/frontend/images/sdg13.svg') }}" class="img-fluid rounded-0" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div> 
                                    </article>
                          </div>
                        <div class="col-md-12 col-lg-3 blog-left-col">
                            <aside class="sidebar  sdg-sticky">
                                <aside class="widget widget-recent-post">
                                    <h2 class="widget-title">Related News</h2>
                                        <ul class="recent-post-list">
                                            <li class="recent-post-list-li "> 
                                                <a class="recent-post-thum" href="#sdg13">
                                                    <img src="{{asset('assets/frontend/images/s30.png') }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="sdgs pbmit-rpw-content ">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="#sdg13">SDG 13</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="#sdg13">Climate Action </a>
                                                    </span>
                                                </div> 
                                            </li>
                                            <li class="recent-post-list-li "> 
                                                <a class="recent-post-thum" href="#sdg5">
                                                    <img src="{{asset('assets/frontend/images/s5.png') }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="sdgs pbmit-rpw-content ">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="#sdg5">SDG 5</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="#sdg5">Gender Equality </a>
                                                    </span>
                                                </div> 
                                            </li>
                                            <li class="recent-post-list-li "> 
                                                <a class="recent-post-thum" href="#sdg2">
                                                    <img src="{{asset('assets/frontend/images/s20.png') }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="sdgs pbmit-rpw-content ">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="#sdg2">SDG 2</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="#sdg2">Zero Hunger and Nutrition </a>
                                                    </span>
                                                </div> 
                                            </li>
                                            <li class="recent-post-list-li "> 
                                                <a class="recent-post-thum" href="#sdg6">
                                                    <img src="{{asset('assets/frontend/images/s6.png') }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="sdgs pbmit-rpw-content ">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="#sdg6">SDG 6</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="#sdg6">Clean Water and Sanitation</a>
                                                    </span>
                                                </div> 
                                            </li>
                                            <li class="recent-post-list-li "> 
                                                <a class="recent-post-thum" href="#sdg3">
                                                    <img src="{{asset('assets/frontend/images/s30.png') }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="sdgs pbmit-rpw-content ">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="#sdg3">SDG 3</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="#sdg3">Good Health and Well-being</a>
                                                    </span>
                                                </div> 
                                            </li>
                                          
                                        </ul>
                                </aside> 
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
           
        </div>
        <!-- page content End -->

        <!-------------------------- footer ----------------------------->
        <!-------------------------- footer ----------------------------->
    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->


@include('frontend.layouts.search_scroll')

<!-- JS
		============================================ -->
<!-- jQuery JS -->
@include('frontend.layouts.include_scripts')

@endsection