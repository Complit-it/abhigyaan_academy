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
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
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
                        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <a href="#info" class="button">
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
                                            <a href="#how-to-join">HOW TO JOIN INDIAN COAST GUARD</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#Elegibility">Eligibility & Syllabus</a>
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
                    <h1>Coast Guard</h1>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/D91s6dqWeiY?si=-g_oiscZ7JVcn0Da" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>

                    </div>
                    <p style="text-align:left"><em><b>Indian coast guard Assistant Commandant </b> Coaching, Yantrik Coaching & Navik (General Duty/Domestic Bank) Coaching in Delhi. </em></p>
                    <p style="text-align:left"><em>Here we not only focus on syllabus but also discuss the strategy to clear the Assistant Commandant, Yantrik & Navik exams. </em></p>
                    <p style="text-align:left"><em>Ex-officers of Indian coast guard come regularly to motivate and guide the students. 
                        So interested candidates can join India’s leading coast guard coaching institute and make their future bright.</em></p>
                    
                    <p style="text-align:left"><em>Coast Guard as an organization has multiple tasks listed against its name. Life in Coast Guard is not only filled with excitement and adventure but also offers a lot of scope to learn and grow. Due to the multiple nature of tasks being performed by Coast Guard ranging from guarding the sea boundary of our country against any illegal immigrants, apprehending poachers, to assisting the fishermen in need at sea and at shore, to conserving the marine bio diversity the personnel receive tremendous amount of experience both in handling manpower and various equipments.</em></p>
                    <p style="text-align:left"><em>
                      Abhigyan Academy, established in 1993, has a 31-year legacy of guiding over 5500+ students to success in the UPSC NDA exam, as well as providing SSB Interview guidance.We believe that every success depends upon a good planning and thus, we lay special emphasis on study material, mock tests, question banks and online/offline tests.</em></p>
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
                            "title" => "Coast Guard REVISION COURSE",
                            "duration" => "2 Months",
                            "price" => "₹25,500",
                            "info" => "Veteran Students who are looking for revision of the syllabus of the NDA/CDS Exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"]
                        ],
                        [
                            "title" => "Coast Guard CRASH COURSE",
                            "duration" => "6 Months",
                            "price" => "₹45,500",
                            "info" => "Veteran as well as Non-Veteran Students in their last attempt requiring a Crash Course for the NDA/CDS exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "Coast Guard REGULAR COURSE",
                            "duration" => "1 Year",
                            "price" => "₹ 60,500",
                            "info" => "Aspirants who have completed their HS or Graduation and want to start from the Basics of the Syllabus",
                            "benefits" => [
                                "SSB training from experts",
                                "Lifetime Coaching after completion of the said tenure i.e 1 Year & 2 Year Course.",
                                "Lifetime Premium access to our application and website for access to classes, study materials & Mock-tests."
                            ],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "Coast Guard BASICS-ADVANCE",
                            "duration" => "2 Years",
                            "price" => "₹ 95,500",
                            "benefits" => [
                                "SSB training from experts",
                                "Lifetime Coaching after completion of the said tenure i.e 1 Year & 2 Year Course.",
                                "Lifetime Premium access to our application and website for access to classes, study materials & Mock-tests."
                            ],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ]
                    ];
        
                    foreach ($courses as $course) {
                        echo "<div class='course-card'>";
                        echo "<h2>{$course['title']}</h2>";
                        echo "<p>Duration: {$course['duration']}</p>";
                        echo "<p class='price'><b>{$course['price']}</b></p>";
                        if (isset($course['info'])) {
                            echo "<p class='batch-info'>{$course['info']}</p>";
                        }
                        echo "<p class='batch-info'><h4>Benefits</h4><ul>";
                        foreach ($course['benefits'] as $benefit) {
                            echo "<li>{$benefit}</li>";
                        }
                        echo "</ul></p>";
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
    


  <section style="padding: 0;margin:0 0 0 0 " id="how-to-join">
        
    <div style="margin-right: 100px;  ">
        <h1 style="text-align: center">HOW TO JOIN INDIAN COAST GUARD (OFFICER)
        </h1>
        <table style="margin-left: 50px;">
            <tr>
                <th>Name of Post</th>
                <th>Branch</th>
                <th>Age as on 1<sup>st</sup> July of the year of recruitment</th>
                <th>Education Qualification</th>
                <th>Physical Standard</th>
            </tr>
            <tr>
                <td>Assistant Commandant(GD) (Male/Female)</td>
                <td>General Duty</td>
                <td>21-25 years of Age (5 years relaxation for SC/ST and 3 years for OBC)</td>
                <td>Bachelor's degree with 60% marks in aggregate of a university recognised by Central/State Govt./UGC and minimum 60% in class XII Std of 10+2+3 scheme of education with Mathematics and Physics as subjects.</td>
                <td>Height 157cms(M)/152cms(F), Weight Proportionate to Height, Eye sight 6/6 & 6/9 without glasses</td>
            </tr>
            <tr>
                <td>Assistant Commandant (GD)-SSA (Female)</td>
                <td>General Duty (Short service appointment for a period of 08 years, which may be extended to 10 years and further extendable upto 14 years)</td>
                <td>21-25 years of Age (5 years relaxation for SC/ST and 3 years for OBC)</td>
                <td>Bachelor's degree with 60% marks in aggregate of a university recognised by Central/State Govt./UGC and minimum 60% in class XII Std of 10+2+3 scheme of education with Mathematics and Physics as subjects.</td>
                <td>Height 152cms, Weight Proportionate to Height, Eye sight 6/6 & 6/9 without glasses</td>
            </tr>
            <tr>
                <td>Assistant Commandant (GD-P/N) (Male/Female)</td>
                <td>General Duty (Pilot/Navigator)</td>
                <td>19-27 years (5 years relaxation for SC/ST and 3 years for OBC)</td>
                <td>B.Sc with Physics & Mathematics and 55% marks in aggregate and minimum 60% in class XII Std of 10+2+3 scheme of education.</td>
                <td>Height Min 162.5 cms Max 197 cm, Leg Length Min 99 cms, Weight Proportionate to Height, Eye sight 6/6 without glasses</td>
            </tr>
            <tr>
                <td>Assistant Commandant (GD-P-CPL) SSA (Male/Female)</td>
                <td>General Duty Branch(Pilot-Commercial Pilot License - Short service appointment for a period of 08 years, which may be extended to 10 years and further extendable upto 14 years)</td>
                <td>19-27 years (5 years relaxation for SC/ST and 3 years for OBC)</td>
                <td>12<sup>th</sup> class passed or equivalent with 60% marks in 10+2 +3 scheme or equivalent and should possess Current Commercial Pilot License on the date of selection</td>
                <td>Height Min 162.5 cms Max 197 cm, Leg Length Min 99 cms, Weight Proportionate to Height, Eye sight 6/6 without glasses</td>
            </tr>
            <tr>
                <td>Assistant Commandant (Tech) (Male/Female)</td>
                <td>Technical Branch</td>
                <td>21-30 years (5 years relaxation for SC/ST and 3 years for OBC)</td>
                <td>Degree with 60% marks in aggregate in Naval Architecture/ Mechanical/ Marine/Electrical/ Electronics & Telecommunications/ Design/Production/Aeronautical/Metallurgy/Aerospace/Control Engineering or equivalent and minimum 60% in class XII Std of 10+2+3 scheme of education.<br>or<br>Should have passed section A and B of Institution of Engineers (India) Examination in any of the discipline listed above with 55% marks</td>
                <td>Height 157 cm Weight Proportionate to Height, Eye sight 6/12 and 6/36</td>
            </tr>
            <tr>
                <td>Deputy Commandant (Law) (Male/Female)</td>
                <td>Law Branch</td>
                <td>Below 45 years (5 years relaxation for Govt. servant)</td>
                <td>(i) A degree in Law with 8 years experiences in legal matters.<br>(ii) Should be qualified for enrolment as an advocate in a High Court.<br>Desirable<br>(i) A post graduate degree in Law.<br>(ii) Knowledge/Experience Assignment connected with International Law/Maritime Law.</td>
                <td>Height 157cms(M)/152cms(F), Weight Proportionate to Height, Eye sight 6/6 and 6/12 (with glass), 6/60 (without glass)</td>
            </tr>
        </table>
        <table style="margin-left:50px;">
            <tr>
                <th>Rank And Pay Structure</th>
            </tr>
            <tr>
                <td>
                    <ul class="list-item" style="margin-left: 55px;">
                        <li>Assistant Commandant: Rs. 15600-39100 with Grade Pay Rs 5400/-</li>
                        <li>Deputy Commandant: Rs. 15600-39100 with Grade Pay Rs 6600/-</li>
                        <li>Commandant(Junior Grade): Rs. 15600-39100 with Grade Pay Rs 7600/-</li>
                        <li>Commandant: Rs. 37400-67000 with Grade Pay Rs 8700/-</li>
                        <li>Deputy Inspector General: Rs. 37400-67000 with Grade Pay Rs 8900/-</li>
                        <li>Inspector General: Rs. 37400-67000 with Grade Pay Rs 10000/-</li>
                        <li>Director General: Rs. 37400-67000 with Grade Pay Rs 12000/-</li>
                    </ul>
                    <p>The pay would include Dearness allowance, Kit Maintenance allowance and Transport allowance. In addition other allowances will be admissible based on nature of duty/place of posting such as flying allowance, sea duty allowance and Island special duty allowance.</p>
                </td>
            </tr>
        </table>
    
        <table style="margin-left:50px;">
            <tr>
                <th>Other benefits</th>
            </tr>
            <tr>
                <td>
                    <ul class="list-item" style="margin-left: 55px;">
                        <li>Entitled rations, medical cover for self and family including dependent parents.</li>
                        <li>Government accommodation for self & family on nominal license fee.</li>
                        <li>45 days Earned leave and 08 days Casual leave every year with leave travel concession for self, family and dependent parents as per Govt. rules.</li>
                        <li>Insurance cover of Rs.40 lakhs at a premium of Rs.4000/- per month as Group insurance.</li>
                        <li>Contributory Pension Scheme, Provident Fund and Gratuity on retirement.</li>
                        <li>Canteen and various loan facilities.</li>
                        <li>Sports and adventure activities such as river rafting, mountaineering, hot air ballooning, hang gliding and wind surfing etc.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

</section>   
<section style="padding: 0;margin:0 0 0 0 " id="how-to-join">
        
    <div style="margin-right: 100px;  ">
        <h1 style="text-align: center">Indian Coast Guard Navik GD Syllabus </h1>
        <p style="margin-left:50px;text-align:left">Candidates must be familiar with the Indian Coast Guard Navik GD syllabus and exam pattern 2024 to get insights into the exam format and type of topics important from the exam perspective. Here are the key highlights of the ICG Navik GD syllabus and exam pattern shared below for the ease of candidates.</p>
        <table style="margin-left: 50px;">
            <thead>
                <tr>
                    <th colspan="2">Indian Coast Guard Navik GD Syllabus and Exam Pattern 2024 Overview</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Organisation</td>
                    <td>Indian Coast Guard</td>
                </tr>
                <tr>
                    <td>Post Name</td>
                    <td>Navik (General Duty)</td>
                </tr>
                <tr>
                    <td>Selection Process</td>
                    <td>
                        <ul style="margin-left: 55px;">
                            <li>Stage I (Computer Based Examination)</li>
                            <li>Stage II (Assessment/Adaptability Test, Physical Fitness Test, Document Verification, and Medical Exam)</li>
                            <li>Stage III (Document Verification and Pre-enrolment Medicals at INS Chilka)</li>
                            <li>Stage–IV (Training)</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td>Maths, Science, English, Reasoning, and General Knowledge.</td>
                </tr>
                <tr>
                    <td>Number of Questions</td>
                    <td>110</td>
                </tr>
                <tr>
                    <td>Maximum Marks</td>
                    <td>110</td>
                </tr>
                <tr>
                    <td>Official Website</td>
                    <td>joinindiancoastguard.cdac.in</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-left: 50px;">
            <thead>
                <tr>
                    <th colspan="2">Indian Coast Guard Navik GD Syllabus 2024</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Subject</td>
                    <td>ICG Navik GD Section I Syllabus</td>
                </tr>
                <tr>
                    <td>Science</td>
                    <td>
                        Nature of Matter (Universe / Planets / Earth / Satellites / Sun), Electricity and its application.<br>
                        Force and Gravitation, Newton's Laws Of Motion, Work, Energy and Power.<br>
                        Heat, Temperature, Metals and Non-Metals, Carbon and its Compounds, Measurements In Science, Sound & Wave Motion, Atomic Structure.
                    </td>
                </tr>
                <tr>
                    <td>Mathematics</td>
                    <td>
                        Mathematical Simplification, Ratio and Proportion, Algebraic Identities, Linear Equations and Polynomials, Simultaneous Equations, Basic Trigonometry.<br>
                        Simple Mensuration, Geometry, Measures of Central Tendency (Average, Median and Mode).<br>
                        Interest, Profit, Loss and Percentage, Work, Time, Speed and Distance.
                    </td>
                </tr>
                <tr>
                    <td>English</td>
                    <td>
                        Passage, Preposition, Correction of sentences, Change active to passive/passive to active voice.<br>
                        Change direct to indirect/indirect to direct, Verbs/Tense/Non Finites, Punctuation.<br>
                        Substituting phrasal verbs for expression, Synonyms and Antonyms, and Meanings of difficult words.<br>
                        Use of adjectives and compound prepositions.<br>
                        Use of pronouns.
                    </td>
                </tr>
                <tr>
                    <td>General Awareness</td>
                    <td>
                        Geography: Soil, Rivers, Mountains, Ports, Inland, Harbours.<br>
                        Culture and Religion, Freedom Movement, Important National Facts about India, Heritage, Arts and Dance.<br>
                        History, Defence, Wars and Neighbours, Awards and Authors, Discoveries, Diseases and Nutrition.<br>
                        Current Affairs, Languages, Capitals and Currencies, Common Names, Full Forms and Abbreviations.<br>
                        Eminent Personalities, National Birds / Animals / Sport / Authors / Anthem / Song / Flag / Mountains.<br>
                        Sports: Championships / Winners / Terms / Number of Players.
                    </td>
                </tr>
                <tr>
                    <td>Reasoning</td>
                    <td>
                        Spatial, Numerical Reasoning & Associative Ability, Sequences, Spellings Uncorrupting, Coding and Decoding.
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="margin-left: 50px;">
            <thead>
                <tr>
                    <th colspan="2">Indian Coast Guard Navik GD Syllabus 2024</th>
                </tr>
                <tr>
                    <th>Subject</th>
                    <th>ICG Navik GD Section II Syllabus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Maths</td>
                    <td>
                        <ul style="margin-left:55px;">
                            <li>Physical world and measurement, Kinematics, Laws of Motion, Work, Energy and Power. Newton’s laws and applications, circular motion.</li>
                            <li>The motion of a System of particles and rigid body, gravitation, Property of Bulk Matter, thermodynamics, behaviour of perfect gas and kinetic theory, Oscillation and Waves.</li>
                            <li>Electrostatics, Current Electricity, Magnetic Effects of current and magnetism, Electromagnetic Induction and alternating currents, Electromagnetic Waves.</li>
                            <li>Optics, Dual Nature of matter and radiation, Atom and Nuclei.</li>
                            <li>Electronic devices, Communicating systems.</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Physics</td>
                    <td>
                        <ul style="margin-left:55px;">
                            <li>Sets, Relations and Functions – Set, Relations and Functions trigonometric functions.</li>
                            <li>Algebra – Principle of Mathematical induction, complex numbers and quadratic equations, linear inequalities, permutation and combinations, binomial theory, sequence and series, Matrices, determinants.</li>
                            <li>Vector And Three Dimensional</li>
                            <li>Geometry – Vectors, and three-dimensional geometry</li>
                            <li>Liner Programming</li>
                            <li>Coordinate Geometry – Straight lines, conic section, introduction to three-dimensional geometry.</li>
                            <li>Calculus – Limits and derivatives, Continuity and differentiability, Applications and derivatives, Integrals, applications of the integrals, differential equations.</li>
                            <li>Probability – Statistics, Probability. Mathematical Simplification, Ratio and Proportion, Algebraic Identities, Linear Equations and Polynomials, Simultaneous Equations, Basic Trigonometry.</li>
                            <li>Relations And Functions – Relations and Functions, inverse trigonometric functions. Simple Mensuration, Geometry, Measures of Central Tendency (Average, Median and Mode.</li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</section>








<section style="padding: 0;margin:0 0 0 0 ">
        
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



