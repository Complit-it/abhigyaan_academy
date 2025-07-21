@extends('layouts.publicLayouts.app')

@section('content')
   

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
                                            <a href="#how-to-prepare">How To Prepare For NDA?</a>
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
                    <h1>NDA Coaching</h1>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/D91s6dqWeiY?si=-g_oiscZ7JVcn0Da" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>

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
                            "title" => "NDA REVISION COURSE",
                            "duration" => "2 Months",
                            "price" => "₹25,500",
                            "info" => "Veteran Students who are looking for revision of the syllabus of the NDA/CDS Exam",
                            "benefits" => ["Special focus on Mock Tests & Doubt Clearing Sessions",
                            "Morning Batch: 10:30am - 02:45pm", 
                            "Evening Batch: 03:30pm - 06:00pm",]
                        ],
                        [
                            "title" => "NDA CRASH COURSE",
                            "duration" => "6 Months",
                            "price" => "₹45,500",
                            "info" => "Veteran as well as Non-Veteran Students in their last attempt requiring a Crash Course for the NDA/CDS exam",
                            "benefits" => [
                                "Special focus on Mock Tests & Doubt Clearing Sessions",
                                "Morning Batch: 10:30am - 02:45pm", 
                                "Evening Batch: 03:30pm - 06:00pm",
                                "Offline/Online Classes Available",
                            ],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "NDA REGULAR COURSE",
                            "duration" => "1 Year",
                            "price" => "₹ 60,500",
                            "info" => "Aspirants who have completed their HS or Graduation and want to start from the Basics of the Syllabus",
                            "benefits" => [
                                "Special focus on Mock Tests & Doubt Clearing Sessions",
                                "Morning Batch: 10:30am - 02:45pm", 
                                "Evening Batch: 03:30pm - 06:00pm",
                                "Offline/Online Classes Available",
                                "Holistic Exam-Centric Approach",
                                "Personal Doubt Clearing Sessions",

                                "Lifetime Coaching after completion of the said tenure i.e 1 Year & 2 Year Course.",
                                "Lifetime Premium access to our application for access to classes, study materials & Mock-tests.",
                            ],
                            "discount" => "*Fee Concession of 10% for Serving Soldiers and Wards of Ex-Servicemen or Retired Defence, Para Military Forces & Students of Sainik / Military Schools."
                        ],
                        [
                            "title" => "NDA BASICS-ADVANCE",
                            "duration" => "2 Years",
                            "price" => "₹ 95,500",
                            "benefits" => [
                                "Special focus on Mock Tests & Doubt Clearing Sessions",
                                "Morning Batch: 10:30am - 02:45pm", 
                                "Evening Batch: 03:30pm - 06:00pm",
                                "Offline/Online Classes Available",
                                "Holistic Exam-Centric Approach",
                                "Personal Doubt Clearing Sessions",
                                "SSB training from experts",
                                "Lifetime Coaching after completion of the said tenure i.e 1 Year & 2 Year Course.",
                                "Lifetime Premium access to our application for access to classes, study materials & Mock-tests.",
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
        <section style="padding: 0%" id="how-to-prepare">
            <h1  style="text-align: center">How To Prepare For NDA?</h1>
           <p style="margin-left:50px;text-align:left"> We would advise dedicated students to buy old question papers and solve them in real-time to assess their strengths and weaknesses. Thereafter, concentrate on maximizing your marks by laying emphasis on each chapter/ topic which affords you a better probability of solving questions within a minute. Our faculty will provide you short cut techniques to do so. Also, work on basics of Grammar to get marks in English. It will bring up your overall merit.</p>
           <p style="margin-left: 50px;text-align:left"><b>NDA Written Exam Coaching Tips</b></p>

           <p style="margin-left: 50px;text-align:left"> Class X Student: Due to advanced technology being used in Air Force, Navy and Army equipment/weaponry, candidates with Physics, Chemistry & Math's are preferred. Therefore, interested candidates must work hard; get good percentage in Xth class to enable them to opt for Physics, Chemistry & Math's as subject after Xth class. However, candidates from Commerce and  Art  stream   can  also appear for NDA exam. Therefore, Counseling of parents and children who want to opt for a career in Defence Services should be done during beginning of class X in schools.</p>
            
            <p style="margin-left: 50px;text-align:left">10+2 Students: Fill up UPSC application form for<b> NDA Written Exam </b> August while studying in class XII. Since syllabus for NDA Written Exam includes syllabus of both XI and XII, prepare for NDA Written exam during summer vacation after XI.
            </p>

            
            <p style="margin-left: 50px;text-align:left">NDA exam has two papers of 2 ½ hrs each. All questions are objective type. First paper of Math's and Second General Ability.
            </p>
            <p style="margin-left: 50px;text-align:left"><b>Mathematics: </b> the syllabus of XI and XII class. There are more questions from Class XI syllabus. Total 120 questions carrying 300 marks. Therefore, a student gets about a minute plus to solve each question. It is essential for candidate to practice shortcut techniques, all possible short cuts are taught and practiced in detail.
            </p>
            <p style="margin-left: 50px;text-align:left"><b>General Ability: </b> paper has 150 questions carrying 600 marks. The candidate has exactly a minute to solve each question. The paper comprises of three sections i.e English, Science and General Knowledge, each section has 50 questions. The candidate should brush up his basic grammar as all questions of English section are on absolute basic grammar involving correction of Errors in a Sentence, ordering of words in a sentence, ordering of sentences in a paragraph, Antonyms, Synonyms and Comprehension etc. At Abhigyan Academy, candidates are made to grasp BASIC GRAMMER and large numbers of practice sessions are held. Mock Tests/Practice Test/Model Papers are also conducted.
            </p>

            <p style="margin-left: 50px;text-align:left">The Science Portion has maximum questions of Physics (more conceptual), Chemistry (quite straight) and Biology (absolutely factual).
            </p>
            <p style="margin-left: 50px;text-align:left"><b> General Knowledge </b> Portion comprises History, Indian Polity, and Geography. Most questions in HISTORY are from Modern Indian History and only a few from Medieval and Ancient History. Students can cut down the load by concentrating more on Modern History of India. Geography portion needs an understanding rather than cramming facts. Indian Polity is absolutely factual and needs mugging up. In current affairs its important to know recent facts about defence, various commissions, heads of govt/private organizations, sports events etc.
            </p>
        </section>
        </div>
    </section>
    {{-- D:\xampp\htdocs\Abhigyan\public\assets\images\GENERAL_20231004_160139_0000[1].png --}}
    <div style="display: flex; justify-content: center; align-items: center; margin:0 0 0 0;padding:0%">
    <img alt="logo" src="/assets/images/GENERAL_20231004_160139_0000[1].png" width="700" height="550">
    </div>
    <section style="padding: 0;margin:0 0 0 0 ">
        
        <div style="margin-right: 100px;  ">
        <section style="padding: 0%;" id="Elegibility">
            <br/>
            <h1  style="text-align: center">Eligibility & Syllabus</h1>
            <p style="text-align: left;margin-left:50px"><b><u>Eligibility Criteria</u></b></p>
            <p style="color: #333;margin-left:50px;text-align:left">The eligibility criteria for NDA are as follows:</p>
        <ol style="margin-left:50px">
            <li>
                <strong>Nationality:</strong> According to NDA eligibility, an applicant who is an Indian citizen is eligible to apply for the upcoming examination. Those who are not a citizen of India and still want to apply for the exam must meet the UPSC NDA eligibility criteria listed below:
            </li>
        </ol>
        <p style="color: #333;margin-left:50px;text-align:left">The candidate applying for the exam must be either:</p>
        <ul style="list-style-type: disc; margin-left: 65px;">
            <li>A Citizen of India</li>
            <li>A Subject of Nepal or</li>
            <li>A subject of Bhutan, or,</li>
            <li>Tibetan refugees who came to India before 1 Jan. 1962, with the intention of permanent settlement.</li>
            <li>A person of Indian origin who migrated from the following countries with the intention of permanent settlement: Pakistan, Sri Lanka, East African Countries of Kenya, Uganda, the United Republic of Tanzania, Zambia, Malawi, Zaire & Ethiopia, and Vietnam.</li>
            <li style="font-weight: bold; color:black ;">Age Limit:</li>
            <ul style="list-style-type: circle; margin-left: 40px;">
                Candidates must be between 16.5 and 19.5 years of age at the time of commencement of the course. The age limits are different for different branches:
                    <ul style="list-style-type: square; margin-left: 20px;">
                        <li>Army: Candidates must be between 16.5 and 19.5 years.</li>
                        <li>Air Force and Navy: Candidates must be between 16.5 and 19.5 years.</li>
                    </ul>
                
            </ul>
            <li>Gender: Male and Female candidates are eligible for NDA.</li>
            <li>Qualifications:
                <ul style="list-style-type: circle; margin-left: 20px;">
                    <li>Army Wing: Candidates must have completed their 10+2 pattern of school education or equivalent examination conducted by a state education board or a university.</li>
                    <li>Air Force and Naval Wings: Candidates must have completed their 10+2 pattern of school education or equivalent with Physics and Mathematics as compulsory subjects, conducted by a state education board or a university.</li>
                </ul>
            </li>
            <li>Note: Candidates appearing in the 10+2 examination are also eligible to apply, provided they meet the above educational qualifications at the time of joining the course.</li>
                <li> Status: Candidates must be unmarried. Marriage is not permitted during the training period at NDA.</li>
        </ul>
        </section>
        </div>

  </section>    





  <section style="padding: 0;margin:0 0 0 0 ">
        
    <div style="margin-right: 100px;  ">
    <section style="padding: 0%;" >
        <br/>
        <h1  style="text-align: center">Exam Pattern</h1>
        <h5 style="color: #2c3e50; margin-left: 50px;">Selection process :</h5>
        <ul style="list-style-type: none; padding: 0; margin-left: 65px;">
            <li style="position: relative; padding-left: 1.5em; ">
                <span style="position: absolute; left: 0; color: black; font-weight: bold;">•</span>
                Written Exam
            </li>
            <li style="position: relative; padding-left: 1.5em;">
                <span style="position: absolute; left: 0; color:black; font-weight: bold;">•</span>
                SSB Selection Test
            </li>
            <li style="position: relative; padding-left: 1.5em;">
                <span style="position: absolute; left: 0; color: black; font-weight: bold;">•</span>
                Medical Examination
            </li>
        </ul>
        <h5 style="color: black; margin-left: 50px;">Written Exam</h5>
        <p style="margin-left: 50px;text-align:left">The written exam for the National Defence Academy is broken into two sections:</p>
        <ul style="list-style-type: none; padding: 0;margin-left:65px; ">
            <li style="position: relative; padding-left: 1.5em; ">
                <span style="position: absolute; left: 0; color:black; font-weight: bold;">•</span>
                Mathematics
            </li>
            <li style="position: relative; padding-left: 1.5em;">
                <span style="position: absolute; left: 0; color:black; font-weight: bold;">•</span>
                General ability
            </li>
        </ul>
        <p style="margin-left: 50px;text-align:left">The written exam has a total of 900 marks because the maths exam carries 300 points and the general ability exam carries 600 points. The General Ability exam covers maths and reasoning, as well as current events, physics, chemistry, history, and English.</p>
        <p style="margin-left: 50px;text-align:left">The written exam for the National Defence Academy (NDA) consists of two papers: Mathematics and General Ability Test (GAT). The exam pattern for NDA written exam is as follows:</p>
        <p style="color: #333;margin-left: 50px;text-align:left">Paper 1: Mathematics</p>
        <ul style="list-style-type: disc; margin-left: 80px;">
            <li>Duration: 2.5 hours</li>
            <li>Maximum Marks: 300</li>
            <li>Questions: Multiple Choice Questions (MCQs)</li>
            <li>Syllabus: The mathematics paper covers topics such as Algebra, Matrices and Determinants, Trigonometry, Analytical Geometry, Differential Calculus, Integral Calculus and Differential Equations, Vector Algebra, Statistics, and Probability.</li>
        </ul>
        <p style="color: #333;margin-left: 50px;">Paper 2: General Ability Test (GAT)</p>
        <ul style="list-style-type: disc; margin-left: 80px;">
            <li>Duration: 2.5 hours</li>
            <li>Maximum Marks: 600</li>
            <li>Questions: Multiple Choice Questions (MCQs)</li>
            <li>Syllabus: The GAT paper is further divided into two sections: English and General Knowledge.
                <ul style="list-style-type: circle; margin-left: 20px;">
                    <li>English: The English section tests candidates' understanding of English grammar, vocabulary, comprehension, and basic communication skills.</li>
                    <li>General Knowledge: The General Knowledge section covers various topics such as Physics, Chemistry, General Science, History, Geography, Current Events, and Social Studies.</li>
                </ul>
            </li>
        </ul >
        <p style="margin-left: 50px;text-align:left">Both papers are conducted on the same day, and each paper is assigned a maximum of 300 marks. The total marks for the written exam are 900 (300 marks for Mathematics + 600 marks for GAT).</p>
        <p style="margin-left: 50px;text-align:left">It's important to note that there is a negative marking in the NDA written exam. For every incorrect answer, one-third (0.33) of the marks allotted to that question are deducted as a penalty.</p>
        <p style="margin-left: 50px;text-align:left">Candidates who qualify for the written exam are then called for the next stages of the selection process, which include the Service Selection Board (SSB) interview, psychological aptitude test, medical examination, and final merit list preparation.</p>
    </section>
    </div>

</section>   







<section style="padding: 0;margin:0 0 0 0 ">
        
    <div style="margin-right: 100px;  ">
    
        

        <h5 style="color:black; margin-left: 50px;">SSB Round</h5>
        <p style="margin-left: 50px;text-align:left">After passing the written exam, candidates must proceed to the SSB phase, which entails a general conference, a basic cognitive test, a psychological examination, and group testing. The duration of this lengthy test is five days.</p>
        <h5 style="color:black; margin-left: 50px;">Medical Test</h5>
        <p style="margin-left: 50px;text-align:left">The candidate must show up for a medical exam after passing the SSB stage of qualification. When an applicant passes the medical examination, the Union Public Service Commission declares him to be a qualified candidate. On the UPSC website, the complete list of candidates who passed is available.</p>
    
    </div>

</section>  




<section style="padding: 0;margin:0 0 0 0 " id="Demo">
        
    <div>
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
 {{-- end --}}

@endsection



