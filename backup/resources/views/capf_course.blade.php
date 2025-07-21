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
                <div class="navbar-collapse justify-content-center d-none d-lg-block;style="padding: 0%;margin:0 0 0 0"">
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
                                            <a href="#how-to-prepare">How To Prepare For CAPF?</a>
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
                   
            <div style="margin-right: 100px; margin-left: 50px;">
                <section id="info">
                    <h1>CAPF (Asst Commandant)</h1>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/-I_MvcTIsts?si=iUWcBHgHtmmVhxK6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    </div>


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
                            "title" => "CAPF REVISION COURSE",
                            "duration" => "2 Months",
                            "price" => "₹25,500",
                            "info" => "Veteran Students who are looking for revision of the syllabus of the NDA/CDS Exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"]
                        ],
                        [
                            "title" => "CAPF CRASH COURSE",
                            "duration" => "6 Months",
                            "price" => "₹45,500",
                            "info" => "Veteran as well as Non-Veteran Students in their last attempt requiring a Crash Course for the NDA/CDS exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions"],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "CAPF REGULAR COURSE",
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
                            "title" => "CAPF BASICS-ADVANCE",
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
    <section style="padding: 0;margin:0 0 0 0 " id="how-to-prepare">
        
        <div style="margin-right: 100px;  ">
          <h1 style="text-align: center">How To Prepare For CAPF?</h1>
          <p style="margin-left: 50px;text-align:left">Our team provides in depth knowledge on all subjects and topics covered in the exam and special emphasis is laid on English Grammar. For paper II our team provides personalized guidance and well researches notes to enable students to write assays and short passages. We also give free spoken English classes to our students. Our results speak for themselves</p>
        </div>
    </section>



    <section style="padding: 0;margin:0 0 0 0 " id="Eligibility">
        
        <div style="margin-right: 100px;  ">
            <h3 style="margin-left:50px;">SCHEDULE OF CAPF EXAM</h3>
    <table style="margin-left:50px;">
        <thead>
            <tr>
                <th>Paper</th>
                <th>Date Of Notification</th>
                <th>Date of Exam</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CAPF</td>
                <td>April, Every Year</td>
                <td>July, Every Year</td>
            </tr>
        </tbody>
    </table>

    <h3 style="margin-left:50px;">Examination Details</h3>
    <table style="margin-left:50px;">
        <thead>
            <tr>
                <th>Paper</th>
                <th>Subject</th>
                <th>Max. Marks</th>
                <th>Duration</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">Paper-I General Ability and Intelligence</td>
                <td class="subject">
                    <ol style="margin-left:50px;text-align:left">
                        <li>General Mental Ability</li>
                        <li>General Science</li>
                        <li>Indian Polity and Economics</li>
                        <li>History</li>
                        <li>Geography</li>
                        <li>Current Events</li>
                    </ol>
                </td>
                <td rowspan="2">250</td>
                <td rowspan="2">2 Hours</td>
                <td rowspan="2">Objective<br>(Multiple Answer Type)</td>
            </tr>
            <tr></tr>
            <tr>
                <td>Paper-II</td>
                <td class="subject">
                    <ol style="margin-left:50px;text-align:left">
                        <li>Essay</li>
                        <li>Precis Writing</li>
                        <li>Comprehension</li>
                    </ol>
                </td>
                <td>150</td>
                <td>2 Hours</td>
                <td>Essay Component in English or Hindi</td>
            </tr>
        </tbody>
    </table>
        </div>
    </section>
    <br/>
    <section style="padding: 0;margin:0 0 0 0 ">
        
        <div style="margin-right: 100px;  ">
          <h1 style="text-align: center">Eligibility & Syllabus</h1>
          <p style="margin-left: 50px;text-align:left"><b>Age:</b> 20-25 years,  </p>
          <p style="margin-left: 50px;text-align:left"><b>Qualification:</b> Graduate Degree (in any stream) or Equivalent (final year students can also apply for UPSC Exam)  </p>
          <p style="margin-left: 50px;text-align:left"><b><u>Syllabus</u></b>
            <br/>
            Paper I : General Ability And Intelligence</p>
            <p style="margin-left: 50px;text-align:left"> The objective type questions with multiple choices in this paper will broadly cover the following areas:</p>
            <p style="margin-left: 50px;text-align:left">
                <ol style="margin-left: 65px;">
                    <li>General Mental Ability: The questions will be designed to test the logical reasoning, quantitative aptitude including numerical ability, and data interpretation.</li>
                    <li> General Science: The questions will be set to test general awareness, scientific temper, comprehension, and appreciation of scientific phenomena of everyday observation including new areas of importance like Information Technology, Biotechnology, Environmental Science.</li>
                    <li>. Current Events of National and International Importance: The questions will test the candidates’ awareness of current events of national and international importance in the broad areas of culture, music, arts, literature, sports, governance, societal and developmental issues, industry, business, globalization, and interplay among nations.</li>
                    <li> Indian Polity and Economy: The questions shall aim to test candidates’ knowledge of the Country’s political system and the Constitution of India, social systems and public administration, economic development in India, regional and international security issues and human rights including its indicators.</li>
                    <li>History of India: The questions will broadly cover the subject in its social, economic and political aspects. This shall also include the areas of growth of nationalism and freedom movement.</li>
                    <li>Indian and World Geography: The questions shall cover the physical, social and economic aspects of geography pertaining to India and the World</li>
                
                </ol>
            </p>
            <p style="margin-left: 50px;text-align:left">Paper II: General Studies, Essay, And Comprehension</p>
            
            <p style="margin-left: 50px;text-align:left">Part-A - Essay questions which are to be answered in a long narrative form either in Hindi or English totaling 80 Marks. The indicative topics are modern Indian history especially of the freedom struggle, geography, polity and economy, knowledge of security and human rights issues, and analytical ability.</p>
         
            <p style="margin-left: 50px;text-align:left">Part-B - Comprehension, précis writing, other communications/language skills to be attempted in English only (Marks 120) - The topics are Comprehension passages, précis writing, developing counter arguments, simple grammar and other aspects of language testing.</p>
        </div>
    </section>

  
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



