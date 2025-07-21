
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
                                            <a href="#exam_pattern">Exam Pattern</a>
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

    
            <h1>CDS Coaching</h1>
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/98ja-O9y__s?si=2HS1lBliJm0popWv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            </div>

            
                    <p><em>Abhigyan Academy, established in 1993, has a 31-year legacy of guiding over 5500+ students to success in the UPSC NDA exam, as well as providing SSB Interview guidance.We believe that every success depends upon a good planning and thus, we lay special emphasis on study material, mock tests, question banks and online/offline tests.</em></p>
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
                            "title" => "CDS REVISION COURSE",
                            "duration" => "2 Months",
                            "price" => "₹25,500",
                            "info" => "Veteran Students who are looking for revision of the syllabus of the NDA/CDS Exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"]
                        ],
                        [
                            "title" => "CDS CRASH COURSE",
                            "duration" => "6 Months",
                            "price" => "₹45,500",
                            "info" => "Veteran as well as Non-Veteran Students in their last attempt requiring a Crash Course for the NDA/CDS exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "CDS REGULAR COURSE",
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
                            "title" => "CDS BASICS-ADVANCE",
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
     
        
    <br/>
    {{-- .course-card {
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    } --}}
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
    <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Hf_hLZkqI1M?si=xTPkma6PcGJ7MpiG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
    </div>
    <section style="padding: 0;margin:0 0 0 0 ">
        
        <div style="margin-right: 100px;  ">
        <section style="padding: 0%" id="faculty">
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
    <section style="padding: 0;margin:0 0 0 0 ">
        
        <div style="margin-right: 100px;  ">
        <section style="padding: 0%" id="exam_pattern">
            <h1  style="text-align: center">Exam Pattern & Syllabus</h1>
           
            <table style="margin-left:50px">
                <thead>
                    <tr>
                        <th>Paper</th>
                        <th>Total Questions</th>
                        <th>Max. Marks</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paper I - English</td>
                        <td>120</td>
                        <td>100</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Paper II - General Ability</td>
                        <td>120</td>
                        <td>100</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Paper III - Maths</td>
                        <td>100</td>
                        <td>100</td>
                        <td>2 Hours</td>
                    </tr>
                </tbody>
            </table>
            <p>Note: 1/3 Negative Marks for each wrong answer are deducted.</p>
        
            <h3 style="text-align: center;">SYLLABUS FOR EACH PAPER</h3>
            <table style="margin-left:50px">
                <tbody>
                    <tr>
                        <td>
                            <h4>Paper I (English)</h4>
                            <ul style="margin-left: 10px;">
                                <li>Spotting Errors</li>
                                <li>Comprehension / Close Comprehension</li>
                                <li>Ordering of Words</li>
                                <li>Ordering of Sentences</li>
                                <li>Analogy / Fill in the Blanks</li>
                                <li>Synonyms</li>
                                <li>Antonyms</li>
                            </ul>
                        </td>
                        <td>
                            <h4>Paper II (General Ability)</h4>
                            <ul style="margin-left: 10px;
                            ">
                                <li>Geography</li>
                                <li>History</li>
                                <li>Indian Polity</li>
                                <li>Economics</li>
                                <li>Current Affairs</li>
                                <li>Physics</li>
                                <li>Chemistry</li>
                                <li>Biology</li>
                            </ul>
                        </td>
                        <td>
                            <h4>Paper III (Elementary Maths)</h4>
                            <ul style="margin-left: 10px;
                            ">
                                <li>Arithmetic</li>
                                <li>Geometry</li>
                                <li>Mensuration</li>
                                <li>Algebra</li>
                                <li>Trigonometry</li>
                                <li>Statistics</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        
            <h3 style="text-align: center">SCHEDULE OF CDS EXAM</h3>
            <table style="margin-left:50px">
                <thead>
                    <tr>
                        <th>Paper</th>
                        <th>Date Of Notification</th>
                        <th>Date of Exam</th>
                        <th>Time of Exam</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CDS – I</td>
                        <td>Nov. Each Year</td>
                        <td>Second Week of Feb. Each Year</td>
                        <td>09:00 – 17:00 Hrs</td>
                    </tr>
                    <tr>
                        <td>CDS – II</td>
                        <td>July Each Year</td>
                        <td>Third Week of Oct. Each Year</td>
                        <td>09:00 – 17:00 Hrs</td>
                    </tr>
                </tbody>
            </table>
        </section>
        </div>
    </section>
    
        <section style="padding: 0;margin:0 0 0 0 ">
        
            <div style="margin-right: 100px;  ">
            <section style="padding: 0%" >
                <br/>
             <h6 style="text-align:center">CDS Written Exam Coaching Tips</h6>
             <p style="margin-left:50px;text-align:left">One can appear for <b>CDS Exam</b>, when he/she is appearing for 3 rd year of Graduation. Both Male and Female can apply for CDS Exam. Female candidates can only apply for Short Service Commission i.e. OTA. CDS Exam has three papers i.e. English, GK & Maths for Permanent Commission i.e. IMA, AF & NA and two i.e. English & GK for candidates applying for Short Service Commission i.e. OTA. Candidates with Arts/Commerce background are eligible for ARMY only.</p> 
             <p style="margin-left:50px;text-align:left">The Abhigyan Academy, provides a Comprehensive One Month (180 hours) and two months (340 Hours) written coaching and has achieved the best success rate.</p>
             <p style="margin-left:50px;text-align:left">The exam starts at 9 a.m. and winds up at 5 p.m. on the same day. Most college students lack mental physical stamina to sit for almost 8 Hours. So, build it up and be prepared for long hours.</p>
             <p style="margin-left:50px;text-align:left">CDS Mathematics: The standard of Mathematics paper will be of Matriculation level. Total 100 questions. Therefore, a student gets about a minute plus to solve each question. It is essential for candidate to practice shortcut techniques, At Abhigyan Academy, all possible short cuts are taught and practiced in detail.</p>
             <p style="margin-left:50px;text-align:left">General Knowledge: The syllabus for the General Knowledge paper is very vast and generic. Analyzing the past five years papers would help or else, you may focus on unnecessary, bulky details that are difficult to comprehend and remember. For example, in History one needs to drastically cut down effort on Ancient and Medieval History.Abhigyan Academy, provide students with Sample Paper and recent Current Affairs Notes prior to the Exam Day.</p>
             <p style="margin-left:50px;text-align:left">English: The English paper is often ignored by candidates who speak reasonably good English. They however, forget that spoken English is quite different from the Pure Application of Correct Grammar in Objective Type Questions. Those candidates who revise and practice the Basic English Grammar sufficiently can secure almost 100% marks in the grammar section, which is almost 70% of the paper. UPSC gets innovative and at times asks you to indentify the wrong statements too. So be prepared for surprises.</p>
             <p style="margin-left:50px;text-align:left">The remaining 30% paper comprises Comprehensions, Antonyms, Synonyms, Analogy. The candidates usually spend a lot of time on this section. It is very difficult to mug up Antonyms and Synonyms; this is something that one builds over a period of time. The Abhigyan Academy teaches you some innovative techniques to solve your paper in a short span of time.</p>
             <br/>
             <br/>
             <p style="margin-left:50px;text-align:left">Are you ready to make your goal of joining the Indian Armed Forces a reality? Greetings from The Abhigyan Academy, your go-to place for the best CDS SSB coaching in India. Our organisation is committed to helping aspirants succeed on the Combined Defence Services (CDS) test by providing them with guidance and support.</p>
             <br/>
             <br/>
             {{-- <h6>Customized Coaching Approach</h6>
             <p style="margin-left:50px;text-align:left"></p>
             <p style="margin-left:50px;text-align:left"></p> --}}
               
            </section>
            </div>
        </section>        
    <section style="padding: 0;margin:0 0 0 0 ">
        
        <div style="margin-right: 100px;  ">
        <section style="padding: 0%;" id="Elegibility">
            <br/>
            <h1  style="text-align: center">Eligibility</h1>
            
            <p style="color: #333;margin-left:50px;text-align:left">For CDS Exam, men and women both are eligible to apply with certain required conditions. Before applying for the CDS Exam, candidates should take note of the following crucial aspects.:</p>
        
        
        <ul style="list-style-type: disc; margin-left: 80px;">
            <li>Applicants must have a permanent residence in India.</li>
            <li>Candidates must have completed their studies or be in their final year or semester.</li>
            <li>The Minimum Age Requirement for CDS Exam is 19 years.</li>
            <li>Women Candidates are eligible to apply for OTA only.</li>
            <li>Candidates need to be in suitable physical condition.</li>
            <li>Eligibility for OTA is restricted to unmarried females, widows who have not remarried, and divorcees who have not remarried, provided they possess the necessary divorce documents. Only unmarried male candidates are eligible for IMA, INA, and AFA.</li> 
        </ul>
        <br/>
        <h4 style="margin-left:50px;">CDS Eligibility 2024 for IMA, INA, AFA & OTA</h6>
        <p style="color: #333;margin-left:50px;text-align:left">Candidates who are applying for the examination must verify that they meet all the CDS Eligibility Requirements for admission. Admission at every stage of the examination will be strictly provisional and depends on meeting the specified eligibility requirements.</p>
        <p style="color: #333;margin-left:50px;text-align:left">The issuance of an Admission Certificate to a candidate does not signify that the Commission has definitively approved their candidature. The verification of eligibility conditions, concerning the original documents, will only be conducted after the candidate has qualified for the interview/Personality Test. Below, we have provided the qualifications necessary for CDS 1 2024.</p>
        <h6 style="margin-left: 50px">CDS Eligibility 2024 Age Limit</h6>
        <p style="color: #333;margin-left:50px;text-align:left">Candidates can check the CDS Age Limit 2024 Requirements below –</p>
        <table style="margin-left: 50px">
            <thead>
                <tr>
                    <th>Academy</th>
                    <th>Age Limit</th>
                    <th>Marital Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Indian Military Academy (IMA)</td>
                    <td>
                        <ul style="margin-left: 5px;">
                            <li>18 – 23 Years</li>
                            <li>Only male candidates (unmarried) born not earlier than 2nd January 2001 and not later than 1st January 2006 are eligible.</li>
                        </ul>
                    </td>
                    <td>Unmarried</td>
                </tr>
                <tr>
                    <td>Indian Naval Academy (INA)</td>
                    <td>
                        <ul style="margin-left: 5px;">
                            <li>18 – 23 Years</li>
                            <li>Only male candidates (unmarried) born not earlier than 2nd January, 2001 and not later than 1st January, 2006 are eligible.</li>
                        </ul>
                    </td>
                    <td>Unmarried</td>
                </tr>
                <tr>
                    <td>Air Force Academy</td>
                    <td>
                        <ul style="margin-left: 5px;">
                            <li>20 – 24 Years</li>
                            <li>i.e. born not earlier than 2nd January 2001 and not later than January 1, 2005.</li>
                        </ul>
                    </td>
                    <td>25 years unmarried or 25 years both married and unmarried.</td>
                </tr>
                <tr>
                    <td>Officers’ Training Academy (SSC Women Non-Technical Course)</td>
                    <td>
                        <ul style="margin-left: 5px;">
                            <li>19 – 25 Years</li>
                            <li>Candidates should have been born before January 2, 2000 and not later than January 1, 2006.</li>
                        </ul>
                    </td>
                    <td>
                        
                            Unmarried females, issueless widows who haven’t remarried, and issueless divorcees who have not remarried are eligible.
                    </td>
                </tr>
                <tr>
                    <td>Officers’ Training Academy (SSC Course for Men)</td>
                    <td>
                        <ul style="margin-left: 5px;">
                            <li>19 – 25 Years</li>
                            <li>Candidates must not be born earlier than 2nd January, 2000 and not later than 1st January, 2006.</li>
                        </ul>
                    </td>
                    <td>Unmarried</td>
                </tr>
            </tbody>
        </table>
        </section>
        </div>
        <br/>
        <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
            <img alt="logo" src="/assets/images/GENERAL_20231004_160139_0000[1].png" width="700" height="550">
            </div>
        <br/>
  </section>  
  

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



