@extends('layouts.publicLayouts.app')

@section('content')
   
{{-- start --}}
<style>

    .course-card {
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    }
    .buttons {
        margin-top: 20px;
    }
    .buttons button {
        margin: 5px;
        padding: 10px 15px;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        border-radius: 4px;
    }
    .buttons button:hover {
        background-color: #0056b3;
    }
</style> 

       
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }
                #info {
                    padding: 0 10px;
                }
                h1 {
                    text-align: center;
                }
                p {
                    text-align: center;
                }
                .container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    margin: 0 auto;
                }
                .container img {
                    margin: 5px;
                    width: 100%;
                    max-width: 250px;
                }
                .video-container {
                    display: flex;
                    justify-content: center;
                    margin: 20px 0;
                }
                iframe {
                    width: 100%;
                    max-width: 800px;
                }
                .section.fee {
                    padding: 0 10px;
                }
                .course-card {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 15px;
                    margin: 10px auto;
                    max-width: 800px;
                }
                .course-card ul {
                    padding-left: 0;
                    list-style-type: none;
                }
                .price, .discount {
                    color: #f00;
                }
                @media (min-width: 600px) {
                    .container {
                        justify-content: space-around;
                    }
                }
            </style>
            <style>
            .course-card {
                margin-bottom: 20px;
            }
            
            .course-card h4 {
                margin-bottom: 10px;
            }
            
            .course-card ul {
                padding-left: 20px; /* Adjust this value as needed */
            }
            
            .course-card li {
                margin-bottom: 5px;
            }
            </style>

        

        <div class="container" style="background-color:#F8F9FA;margin-bottom:20px;padding:0%">
            <nav class="navbar navbar-expand-lg"> 
                <div class="navbar-collapse justify-content-center d-none d-lg-block" style="padding: 0%;margin:0 0 0 0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent" style="padding: 0%">
                            <ul class="navbar-nav" style="padding: 0%">
                                <a href="#info" class="button" style="padding: 0%">
                                    <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                        Info
                                    </li>
                                </a>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#fee" class="button">Fee Structure</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#faculty">Faculty</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#hostel">HOSTEL/PG & MESS FACILITY</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#ssb_interview_procedure">SSB Interview Procedure
                                            </a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#sb_interview_coaching">SSB Interview Coaching</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#Demo">Demo Classes</a>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </nav>
        </div>
        
    

        
            <div style="margin-right: 100px; margin-left: 50px;">
                <section id="info">
                    <h1>SSB Interview</h1>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/D91s6dqWeiY?si=-g_oiscZ7JVcn0Da" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>

                    </div>
                    <p><em>The Aspirants who clear written exams such as CDS,OTA,AFCAT NDA, TA, and Coast Guard are then called by respective SSB boards for SSB interviews. One can also appear for the SSB interview by getting shortlisted direct entries – TES, TGC, UES, SSC Tech, etc.Abhigyan Academy, established in 1993, has a 31-year legacy of guiding over 5500+ students to success in the UPSC NDA exam, as well as providing SSB Interview guidance.We believe that every success depends upon a good planning and thus, we lay special emphasis on study material, mock tests, question banks and online/offline tests.</em></p>
                    <h1>Top-Rankers</h1>
                    <div class="container">
                        <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                            <img alt="logo" src="/assets/images/Faculty/student/aarav.png" width="700" height="350">
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                <img alt="logo" src="/assets/images/Faculty/student/alicia.png" width="700" height="350">
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                    <img alt="logo" src="/assets/images/Faculty/student/AVINASH.png" width="700" height="350">
                                    </div>
                                    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                        <img alt="logo" src="/assets/images/Faculty/student/kajal.png" width="700" height="350">
                                        </div>

                    </div>
                   
                </section>
                
                <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/BabC2Ytmr_A?si=WKb0aA4EiSahhKhc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <br/>
                <section class="section fee" id="fee">
                    <h1>FEE STRUCTURE</h1>
                    <?php
                    $courses = [
                       
                        [
                            "title" => "SSB BASICS-ADVANCE",
                            "duration" => "2 Years",
                            "price" => "₹ 25,500",

                            "benefits" => [
                                "3 Days/Week",
                                
                                "One-on-One Mentorship",
                                "Mock Personal Interviews, Psychological Tests & GTO Tasks",
                                "Holistic Exam-Centric Approach",
                                "Guidance till you get in the services"
                            ],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ]
                    ];
                
                    foreach ($courses as $course) {
                        echo "<div class='course-card'>";
                        echo "<h2>{$course['title']}</h2>";
                        echo "<p>Duration: {$course['duration']}</p>";
                        echo "<p>Morning Batch: 11:00am - 02:00pm</p>";
                        echo "<p>Evening Batch: 04:00pm - 06:00pm</p>";
                        
                        echo "<p class='price'><b>{$course['price']}</b></p>";
                        if (isset($course['info'])) {
                            echo "<p class='batch-info'>{$course['info']}</p>";
                        }
                        echo "<h4>Benefits</h4>";
                        echo "<ul style='list-style-type: disc; text-align: left;'>";
                        foreach ($course['benefits'] as $benefit) {
                            echo "<li>{$benefit}</li>";
                        }
                        echo "</ul>";
                        if (isset($course['discount'])) {
                            echo "<p class='discount'>{$course['discount']}</p>";
                        }
                        echo "</div>";
                    }
                    ?>
                </section>
               
                
            </div>
      
        <section style="padding: 0;margin:0 0 0 0 " id="hostel">
        
            <div style="margin-right: 100px;  ">
                <h1 style="text-align: center">Hostel/PG Facility</h1>
                <div style=" justify-content: center; align-items: center;margin-left:50px;padding:25px;">
                    <div style="border: 4px double black; padding: 10px; text-align: center;">
                        <p><b>Admission Fees:</b> 2000 (Non Refundable)</p>
                        <p><b>Security Deposit: </b> Month Fees (Refundable)</p>
                        <p><b>Monthly Fees</b></p>
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li>1 Seater: 8999</li>
                            <li>2 Seater W/R: 7999</li>
                            <li>2 Seater P/R: 7499</li>
                            <li>3 Seater: 6999</li>
                            <li>2 Seater A/B: 8499</li>
                        </ul>
                        <p><b>Air Conditioner Room</b></p>
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li>3 Seater A/B: 11999</li>
                            <li>4 Seater A/B: 9999</li>
                        </ul>
                    </div>
                </div>
                
        </section> 
        
    <br/>

    <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Hf_hLZkqI1M?si=xTPkma6PcGJ7MpiG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
    </div>
    <section style="padding: 0;margin:0 0 0 0 " id="faculty">
        
        <div style="margin-right: 100px;  ">
        <section style="padding: 0%" id="how-to-prepare">
            <h1  style="text-align: center">Faculty</h1>
            <div class="container">
                <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                    <img alt="logo" src="/assets/images/Faculty/agan.png" width="700" height="350">
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                        <img alt="logo" src="/assets/images/Faculty/niky.png" width="700" height="350">
                        </div>
                        <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                            <img alt="logo" src="/assets/images/Faculty/alongbar.png" width="700" height="350">
                            </div>
            </div>
            <div class="container">
                            <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                <img alt="logo" src="/assets/images/Faculty/bedanta.png" width="700" height="350">
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                    <img alt="logo" src="/assets/images/Faculty/bisal.png" width="700" height="350">
                                    </div>
                                    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                        <img alt="logo" src="/assets/images/Faculty/nikita.png" width="700" height="350">
                                        </div>
            </div>
            <div class="container">
                                        <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                            <img alt="logo" src="/assets/images/Faculty/pallabi.png" width="700" height="350">
                                            </div>
                                            
                                                                  
                                                <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                                    <img alt="logo" src="/assets/images/Faculty/pragya.png" width="700" height="350">
                                                    </div>
                                                    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                                        <img alt="logo" src="/assets/images/Faculty/renu.png" width="700" height="350">
                                                        </div>
            </div>
            <div class="container">
                                                        <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                                            <img alt="logo" src="/assets/images/Faculty/sudarshina.png" width="700" height="350">
                                                            </div>
                                                            <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                                                <img alt="logo" src="/assets/images/Faculty/sonia.png" width="700" height="350">
                                                                </div>
                                                                <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
                                                                    <img alt="logo" src="/assets/images/Faculty/pratiksha.png" width="700" height="350">
                                                                    </div>
            </div>
        </section>
        </div>
    </section>
    <section style="padding: 0;margin:0 0 0 0 " id="ssb_interview_procedure">
        
        <div style="margin-right: 100px;  ">
        <h1 style="text-align:center">SSB Interview Procedure</h1>
        <p style="text-align: left;margin-left:50px">Below is the 5 day SSB procedure for all SSB interviews. This SSB interview process may vary per the requirement of the SSB Board and the type of entry you appear for. Check SSB Selection Process for CDS, AFCAT, and other entries below.</p>
        <h5 style="text-align: left;margin-left:50px">Day 0 (Reporting)</h5>
        <p style="text-align: left;margin-left:50px">
            <ul style="margin-left: 65px;">
                <li>The Aspirants are usually received at the station by an officer(s) of the board, and from there, they are taken to the selection centre.</li>
                <li>After the Aspirants are settled in, an ‘Opening Address’ takes place where an officer of the board briefs them of their stay for the next 5 days.</li>
                <li>Document Verification takes place and the original documents of the Aspirants are verified</li>
                <li>In some boards (esp. Air Force), the Reporting day is regarded as Day 1 of SSB, and the testing starts on the same day</li>
            </ul>
        </p>
        <h5 style="text-align: left;margin-left:50px">Day 1 (Screening)</h5>
        <p style="text-align: left;margin-left:50px">
            <ul style="margin-left: 65px;">
                <li>Officer Intelligence Rating Test(OIR Test)</li>
                <li>Picture Perception & Discussion Test (PP&DT)</li>
            </ul>
        </p>
        <h5 style="text-align: left;margin-left:50px">Day 2 (Psychology Test)</h5>
        <p style="text-align: left;margin-left:50px">
            <ul style="margin-left: 65px;">
                <li>Thematic Apperception Test (TAT)</li>
                <li>Situation Reaction Test (SRT)</li>
                <li>Self-Description Test (SDT)</li>
                <li>Personal Interview (Between day two to day four)</li>
                
            </ul>
        </p>
        <h5 style="text-align: left;margin-left:50px">Day 3 (Group Testing – I)</h5>
        <p style="text-align: left;margin-left:50px">
            <ul style="margin-left: 65px;">
                <li>Group Discussion</li>
                <li>Group Planning Exercise (GPE)</li>
                <li>Progressive Group Task (PGT)</li>
                <li>Half Group Task (HGT)</li>
                <li>Group Obstacle Race (GOR)</li>
            </ul>
        </p>
        <h5 style="text-align: left;margin-left:50px">Day 4 (Group Testing – II)</h5>
        <p style="text-align: left;margin-left:50px">
            <ul style="margin-left: 65px;">
                <li>Lecturette</li>
                <li>Individual Obstacles (IO)</li>
                <li>Command Task (CT)</li>
                <li>Final Group Task (FGT)O)</li>
            </ul>
        </p>
        <h5 style="text-align: left;margin-left:50px">Day 5 (Conference)</h5>
        </div>
    </section>


    <section style="padding: 0;margin:0 0 0 0 " id="sb_interview_coaching">
        
        <div style="margin-right: 100px;  ">
        <h1 style="text-align:center">SSB Interview Coaching</h1>
        <p style="text-align: left;margin-left:50px">The Aspirants who clear written exams such as <b>CDS,OTA,AFCAT NDA, TA, and Coast Guard</b> are then called by respective SSB boards for SSB interviews. One can also appear for the SSB interview by getting shortlisted through direct entries –<b> TES, TGC, UES, SSC Tech,</b> etc.Entering the military involves not just scholastic achievement but also extraordinary aptitude and leadership skills. Abhigyan Academy intervenes in this situation.Our team of seasoned specialists at Abhigyan_Academy has a wealth of expertise in coaching AFSB SSB interviews. Our teachers have experience in the military and are familiar with the nuances of the SSB interview.</p>
        <p style="text-align: left;margin-left:50px"><b>Entire Curriculum Designed for Achievement:</b>
        </p>
        <p style="text-align: left;margin-left:50px">All facets of the SSB interview are covered in our painstakingly designed SSB interview coaching, including psychological testing, group discussions, in-person interviews, and physical fitness evaluations. Every module is created to optimise your capabilities and preparedness.</p>
        <p style="text-align: left;margin-left:50px">While you get the best SSB coaching in Delhiwith The Abhigyan_Academy, take a step towards personal development and embark on a life-changing adventure. Our all-encompassing top 10 SSB interview coaching in Delhiplaces a strong emphasis on character development, giving you the virtues of self-control, honesty, and tenacity.</p>


        <p style="text-align: left;margin-left:50px"><b>Customised Method for Individual Development:</b>
        </p>
        <p style="text-align: left;margin-left:50px">We provide the best SSB coaching in Indiabased on your areas of strength and growth since we understand that each applicant is different. We concentrate on improving your abilities and bolstering your confidence through coaching for SSB.</p>
        <p style="text-align: left;margin-left:50px">We provide you with the individualised attention and resolute support you need to overcome obstacles and become a leader in every sense of the term. Become a part of our community of motivated people who are passionate about quality SSB coaching.</p>
        </div>
        <p style="text-align: left;margin-left:50px"><b>Innovative Methods and Approaches:</b></p>
        <p style="text-align: left;margin-left:50px">With our innovative methods and the best coaching for SSB interviews, you may stay one step ahead of the competition and improve your performance throughout the whole SSB interview preparation. We cover everything, including body language and time management with the SSB best coaching.</p>
        <p style="text-align: left;margin-left:50px"><b>Mock Exams and Simulations to Prepare for the Real World:</b></p>
        <p style="text-align: left;margin-left:50px">Test your abilities in our accurate simulations and mock exams, which replicate the genuine CDs SSB interview setting. Get helpful criticism from our tutors to improve your strategy and get past obstacles.</p>
        <p style="text-align: left;margin-left:50px"><b>Holistic growth:</b></p>
        <p style="text-align: left;margin-left:50px">We at Abhigyan_Academy are committed to fostering growth that extends beyond academic brilliance. Our best SSB coaching in Indiafosters the resilience, collaboration, and leadership skills necessary for a prosperous military career.</p>
        <p style="text-align: left;margin-left:50px"><b>Proven Track Record of Success:</b></p>
        <p style="text-align: left;margin-left:50px">Abhigyan Academy is evidence of our dedication to quality, having consistently produced top-ranking applicants in SSB jag interviews. Come along and help us lead the road to success with the best SSB interview coaching.</p>
        <p style="text-align: left;margin-left:50px"><b>Cutting Edge Resources and Facilities:</b></p>
        <p style="text-align: left;margin-left:50px">Train in a welcoming setting with cutting-edge amenities and tools to aid in your educational process. Our study guides, libraries, and SSB coaching Delhiare all set up to promote the best possible learning outcomes.</p>
        <p style="text-align: left;margin-left:50px"><b>Convenient Flexible Learning Options:</b></p>
        <p style="text-align: left;margin-left:50px">We provide flexible learning alternatives to meet your schedule since we recognise how hectic life can be. Select from batches produced on weekdays or weekends to ensure convenience without sacrificing SSB preparation.</p>
        <p style="text-align: left;margin-left:50px"><b>Unmatched Assistance and Counselling:</b></p>
        <p style="text-align: left;margin-left:50px">At every step of the route, from registration to selection, our staff offers unmatched assistance and direction. Our goal is to support you in realising your aspirations of proudly and honourably serving your country.</p>
        <p style="text-align: left;margin-left:50px">You may go forth with confidence and tenacity on your path to success when Abhigyan_Academy is your reliable partner for the best SSB interview coaching in Delhi. Enrol in our coaching programme right now to unleash your potential for success in the SSB interview and open the door to a fulfilling military career.

        </p>
        <p style="text-align: left;margin-left:50px">Together, let's make your dreams come true and clear the way for a rewarding future in the armed forces. Enrol at Abhigyan Academy right now to take advantage of top SSB coaching in Delhi.</p>
    </section>
    {{-- D:\xampp\htdocs\Abhigyan\public\assets\images\GENERAL_20231004_160139_0000[1].png --}}
    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
    <img alt="logo" src="/assets/images/GENERAL_20231004_160139_0000[1].png" width="700" height="550">
    </div>
    <section style="padding: 0;margin:0 0 0 0 " id="Demo">
        
        <div  ">
        <section style="padding: 0%;" id="Elegibility">
            <br/>
            <h1  style="text-align: center">Demo Classes</h1>
            <div class="video-container" style="padding:0;margin:0 0 0 0;background-color:white">
                <iframe width="620" height="315" src="https://www.youtube.com/embed/XGf5nOXuyZE?si=yfwrxG2W4P4QHAE7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
            </div>
            
            <br/>
            <div class="video-container" style="padding:0;margin:0 0 0 0;">
                    <iframe width="620" height="315" src="https://www.youtube.com/embed/GPOt-qfRAts?si=AzHHifwFKMXwHlMr" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
            </div>
           
            <br/>
                <div class="video-container" style="padding:0;margin:0 0 0 0;">
                    <iframe width="620" height="315" src="https://www.youtube.com/embed/C_6ji4Lz1JE?si=HNzda1EWVdNnU_1n" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                </div>
                
            
    
       
            
        </section>
        </div>
    
    </section> 
    <br/>
 {{-- end --}}

@endsection



