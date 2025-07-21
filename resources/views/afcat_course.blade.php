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
        width: 90%;
        border-collapse: collapse;
        margin-bottom: 20px;
        margin-left: 50px;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: center;
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
                                            <a href="#exam_detail">Examination Detail</a>
                                        </span>
                                    </a>
                                </li>
                                <li class="ps-menuitem-root Sidebar_menuItem_KX1TI css-1t8x7v1" style="display: flex; align-items: center; height: 50px; text-decoration: none; color: inherit; box-sizing: border-box; cursor: pointer; padding-right: 20px; padding-left: 20px;">
                                    <a class="ps-menu-button" data-testid="ps-menu-button-test-id" tabindex="0"> 
                                        <span class="ps-menu-label css-12w9als">
                                            <a href="#Eligibility">Eligibility & Syllabus</a>
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
                    <h1>AFCAT</h1>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/D91s6dqWeiY?si=-g_oiscZ7JVcn0Da" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>

                    </div>
                    <p><em>AFCAT is the Air Force Common Admission Test conducted by the Indian Air Force twice each year. After clearing the AFCAT, one has to go for the SSB interview conducted by the Air Force Selection Board. If you want to clear the AFCAT, then you need to look for a good coaching institute for proper training.Abhigyan Academy, established in 1993, has a 31-year legacy of guiding over 5500+ students to success in the UPSC NDA exam, as well as providing SSB Interview guidance.We believe that every success depends upon a good planning and thus, we lay special emphasis on study material, mock tests, question banks and online/offline tests.</em></p>
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
                            "title" => "AFCAT REVISION COURSE",
                            "duration" => "2 Months",
                            "price" => "₹25,500",
                            "info" => "Veteran Students who are looking for revision of the syllabus of the NDA/CDS Exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"]
                        ],
                        [
                            "title" => "AFCAT CRASH COURSE",
                            "duration" => "6 Months",
                            "price" => "₹45,500",
                            "info" => "Veteran as well as Non-Veteran Students in their last attempt requiring a Crash Course for the NDA/CDS exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "AFCAT REGULAR COURSE",
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
                            "title" => "AFCAT BASICS-ADVANCE",
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
    
    <br/>
    <section style="padding: 0;margin:0 0 0 0 " id="exam_detail">
        
        <div style="margin-right: 100px;  ">
        <h1 style="text-align: center">Examination Detail & Schedule Of Examination</h1>
        <table>
            <thead>
                <tr>
                    <th>DURATION</th>
                    <th>No. of Question</th>
                    <th>MARKS</th>
                    <th>NEGATIVE MARKING</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2 hours</td>
                    <td>100</td>
                    <td>All Ques will be of Three Marks Each</td>
                    <td>For Every Wrong Answer One Mark will be Reduced</td>
                </tr>
            </tbody>
        </table>
    
        <p><b>Schedule Of Examination</b></p>
    
        <table>
            <thead>
                <tr>
                    <th>PAPER</th>
                    <th>AVAILABILITY OF FORMS</th>
                    <th>DATE OF EXAMINATION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AFCAT - I</td>
                    <td>December</td>
                    <td>February</td>
                </tr>
                <tr>
                    <td>AFCAT - II</td>
                    <td>June</td>
                    <td>August</td>
                </tr>
            </tbody>
        </table>
        </div>
    </section>
    <br/>
    <section style="padding: 0;margin:0 0 0 0 " id="Eligibility">
        
        <div style="margin-right: 100px;  ">
        <h1 style="text-align: center">Eligibility & Syllabus</h1>
        <p style="margin-left:50px;text-align:left">AFCAT Eligibility Criteria consists of nationality, age limit, marital status, educational qualification, and physical standards. The overall eligibility criteria for AFCAT 2024 are as follows:</p>
        <table style="margin-left: 50px;">
            <tr>
                <th>Particulars</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>Nationality</td>
                <td>Indian</td>
            </tr>
            <tr>
                <td>Marital Status</td>
                <td>Unmarried</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>Men & Women</td>
            </tr>
            <tr>
                <td>Age Limit</td>
                <td>Flying Branch: 20-24 years<br>Ground Duty: 20-26 years</td>
            </tr>
            <tr>
                <td>Educational Qualification</td>
                <td>Min 60% in Maths & Physics in 10+2<br>Graduate</td>
            </tr>
            <tr>
                <td>Physical Conditioning</td>
                <td>Run 1.6 km in 10 minutes<br>10 push ups<br>03 chin ups</td>
            </tr>
            <tr>
                <td>Height (Male)</td>
                <td>Flying Branch- 162.5 cm<br>Ground Duty Branches- 157.5 cm<br>Others- 152.5-155.5 cm</td>
            </tr>
            <tr>
                <td>Height (Female)</td>
                <td>Flying Branch- 162.5 cm<br>Other Branches- 152 cm<br>For Hilly/North-East Regions: 147-150 cm<br>For Lakshadweep- 150 cm</td>
            </tr>
        </table>
        
    <p style="margin-left:50px;text-align:left">Syllabus</p>
        <table>
            <tr>
                <td>General Awareness</td>
                <td>History, Sports, Geography, Environment, Civics, Basic Science, Defence, Art, Culture, Current Affairs, Politics etc.</td>
            </tr>
            <tr>
                <td>Verbal Ability in English</td>
                <td>Comprehension, Error Detection, Sentence Completion, Synonyms, Antonyms and Testing of Vocabulary.</td>
            </tr>
            <tr>
                <td>Numerical Ability</td>
                <td>Decimal Fraction, Simplification, Average, Profit & Loss, Percentage, Ratio & Proportion and Simple Interest.</td>
            </tr>
            <tr>
                <td>Reasoning and Military Aptitude Test</td>
                <td>Verbal Skills and Spatial Ability.</td>
            </tr>
        </table>
        
        </div>
    </section>
    {{-- D:\xampp\htdocs\Abhigyan\public\assets\images\GENERAL_20231004_160139_0000[1].png --}}
    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
    <img alt="logo" src="/assets/images/GENERAL_20231004_160139_0000[1].png" width="700" height="550">
    </div>
    

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



