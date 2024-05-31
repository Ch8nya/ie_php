<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT buy_status FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$buy_status = $row['buy_status'];

if ($buy_status != 1) {
    header("Location: buy.php");
    exit();
}
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Tue Apr 16 2024 10:48:33 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="ie-site-final.webflow.io" data-wf-page="660eaa71aa6222fb22563105"
    data-wf-site="660eaa71aa6222fb22563027" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Projects</title>
    <meta content="Projects" property="og:title" />
    <meta content="Projects" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link
        href="styles.css"
        rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script
        type="text/javascript">WebFont.load({ google: { families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] } });</script>
    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link href="https://assets-global.website-files.com/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets-global.website-files.com/img/webclip.png" rel="apple-touch-icon" />
</head>

<body>
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
        role="banner" class="navbar w-nav">
        <div class="loggnavigation-wrap"><a href="Program.html" class="logo-link w-nav-brand"><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66183e8fa5ff3d56423fffbc_Frame%201%20(1).png"
                    width="Auto" alt="" class="logo-image-2" /></a>
            <div class="menumob">
                <nav role="navigation" class="navigation-items w-nav-menu">
                    <div class="module-navigator2">
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583cdda"
                            class="accordion-item2 w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 1</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module1-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module1-lesson2" class="w-dropdown-link">Lesson 2</a><a href="#" id="module1-lesson3"
                                    class="w-dropdown-link">Lesson 3</a>
                            <a href="#" id="module1-lesson4"
                                    class="w-dropdown-link">Lesson 4</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583cde6"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 2</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module2-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module2-lesson2" class="w-dropdown-link">Lesson 2</a><a href="#" id="module2-lesson3"
                                    class="w-dropdown-link">Lesson 3</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583cdf2"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 3</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module3-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module3-lesson2" class="w-dropdown-link">Lesson 2</a><a href="#" id="module3-lesson3"
                                    class="w-dropdown-link">Lesson 3</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583cdfe"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 4</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module4-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module4-lesson2" class="w-dropdown-link">Lesson 2</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583ce0a"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 5</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module5-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module5-lesson2" class="w-dropdown-link">Lesson 2</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583ce16"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 6</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module6-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module6-lesson2" class="w-dropdown-link">Lesson 2</a><a href="#" id="module6-lesson3"
                                    class="w-dropdown-link">Lesson 3</a></nav>
                        </div>
                        <div data-hover="false" data-delay="0" data-w-id="5b05f17a-dcf6-7fdd-875a-219de583ce22"
                            class="accordion-item w-dropdown">
                            <div class="accordion-toggle w-dropdown-toggle">
                                <div class="accordion-icon w-icon-dropdown-toggle"></div>
                                <div>Module 7</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list"><a href="#" id="module7-lesson1" class="w-dropdown-link">Lesson
                                    1</a><a href="#" id="module7-lesson2" class="w-dropdown-link">Lesson 2</a></nav>
                        </div>
                <a href="#" class="link-block w-inline-block">
                            <div class="text-block-10">Internship Certification Assessment Test</div><img
                                src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                                loading="lazy" width="12" alt="" />
                        </a>
                    </div>
                </nav>
            </div>
            <div class="menu-button2 w-nav-button"><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/660eaa71aa6222fb22563122_menu-icon.png"
                    width="22" alt="" class="menu-icon" /></div>
            <div class="div-block-32"><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6617cfc9697e223befcc78d5_icons8-circle-30.png"
                    loading="lazy" alt="" class="image-10" />
                <div class="progress">Your Progress</div><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66183f175b94606c96dcdc4a_icons8-user-30%20(1).png"
                    loading="lazy" alt="" class="image-12" />
                <div class="uname"><?php   $sql = "SELECT first_name FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];  echo htmlspecialchars($first_name); ?></div>
            </div>
            <div class="div-block2"><a href="logout.php" class="button login logout-btn w-inline-block"><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66183bca5e4b790f772ecaf8_icons8-exit-30.png"
                        loading="lazy" alt="" class="image-13" /></a></div>
        </div>
    </div>
    <div class="div-block-33">
        <div class="title-div">
            <h1 class="heading-2">Module Title</h1>
            <h1 class="sub-heading">Lesson Title</h1>
            <div class="content"></div>
                <a href="#"
                class="button-3 w-button">Next</a>
        </div>
        <div class="module-navigator">
            <div data-hover="false" data-delay="0" data-w-id="b044b582-3f40-76ae-4ece-d6923fd6e10a" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div data-w-id="d4e60bc9-5113-47f2-59e1-61b39e9ead24" class="accordion-icon w-icon-dropdown-toggle">
                    </div>
                    <div>Module 1</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module1-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module1-lesson2"
                        class="w-dropdown-link">Lesson 2</a><a href="#" id="module1-lesson3" class="w-dropdown-link">Lesson 3</a><a href="#" id="module1-lesson4" class="w-dropdown-link">Lesson 4</a>
                    </nav>
                    </nav>           
                    </nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="58a16ce9-ca28-4b7f-f1e7-2c6811832b9c" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 2</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module2-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module2-lesson2"
                        class="w-dropdown-link">Lesson 2</a><a href="#" id="module2-lesson3" class="w-dropdown-link">Lesson 3</a></nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="a22872eb-9328-53a8-f86e-540586c0424d" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 3</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module3-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module3-lesson2"
                        class="w-dropdown-link">Lesson 2</a><a href="#" id="module3-lesson3" class="w-dropdown-link">Lesson 3</a></nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="ff0ea052-498a-5169-61f9-184190733c8b" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 4</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module4-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module4-lesson2"
                        class="w-dropdown-link">Lesson 2</a></nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="ac0bb70e-a391-03c9-c124-2f390c6232e0" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 5</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module5-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module5-lesson2"
                        class="w-dropdown-link">Lesson 2</a></nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="6c8c6b26-aaa7-8d31-71fb-f75604b62dbc" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 6</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module6-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module6-lesson2"
                        class="w-dropdown-link">Lesson 2</a><a href="#" id="module6-lesson3" class="w-dropdown-link">Lesson 3</a></nav>
            </div>
            <div data-hover="false" data-delay="0" data-w-id="ac24a588-f17e-28e7-8bf3-a7221f1b69d3" style="height:80px"
                class="accordion-item w-dropdown">
                <div class="accordion-toggle w-dropdown-toggle">
                    <div class="accordion-icon w-icon-dropdown-toggle"></div>
                    <div>Module 7</div><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                        loading="lazy" width="12"
                        style="-webkit-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)"
                        alt="" class="arrow accordion-icon" />
                </div>
                <nav class="dropdown-list w-dropdown-list"><a href="#" id="module7-lesson1" class="w-dropdown-link">Lesson 1</a><a href="#" id="module7-lesson2"
                        class="w-dropdown-link">Lesson 2</a></nav>
            </div>
            <a href="#" class="link-block w-inline-block">
                <div class="text-block-10">Internship Certification Assessment Test</div><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/6618d0cfd9722ce6d3838f48_chevron-down.png"
                    loading="lazy" width="12" alt="" class="arrow" />
            </a>
        </div>
    </div>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=660eaa71aa6222fb22563027"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="script.js"
        type="text/javascript"></script>
        <script src="titles.js"></script>

        <script>
  // Get references to the relevant HTML elements
  const nextButton = document.querySelector('.button-3');
  const contentDiv = document.querySelector('.content');

  // Initialize the current lesson and module
  let currentLesson = 1;
  let currentModule = 1;

  // Attach a click event listener to the "Next" button
  nextButton.addEventListener('click', loadNextLesson);

  // Function to load a specific lesson
  function loadLesson(moduleNumber, lessonNumber) {
    // Construct the file path for the specified lesson
    const lessonFilePath = `content/module${moduleNumber}/lesson${lessonNumber}.html`;

    // Send an AJAX request to load the lesson HTML file
    fetch(lessonFilePath)
      .then(response => {
        if (!response.ok) {
          throw new Error(`Lesson not found: ${response.status}`);
        }
        return response.text();
      })
      .then(data => {
        // Update the lesson content container with the new content
        contentDiv.innerHTML = data;
      })
      .catch(error => {
        console.error('Error loading lesson:', error);
        contentDiv.innerHTML = '<p>Lesson not found. Please check the module and lesson numbers.</p>';
      });
  }

    function saveProgress(moduleNumber, lessonNumber) {
  // Fetch the current progress from the server
  fetch('get_progress.php')
    .then(response => response.json())
    .then(data => {
      const currentModule = data.moduleNumber;
      const currentLesson = data.lessonNumber;

      // Only update if the new progress is greater
      if (moduleNumber > currentModule || (moduleNumber === currentModule && lessonNumber > currentLesson)) {
        return fetch('save_progress.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ moduleNumber: moduleNumber, lessonNumber: lessonNumber })
        });
      } else {
        // If not updating, log a message
        console.log('Progress not updated: New progress is not greater than current progress.');
        return Promise.resolve({ ok: true, json: () => ({ status: 'skipped' }) });
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`Error saving progress: ${response.statusText}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.status === 'success') {
        console.log('Progress saved successfully:', data);
      } else {
        console.log('Progress not updated:', data.message || 'Skipped');
      }
    })
    .catch(error => {
      console.error('Error saving progress:', error);
    });
}

  // Updated function to load the next lesson
function loadNextLesson() {
  // Increment the lesson number
  currentLesson++;

  // Check if the next lesson file exists before updating the content
  const lessonFilePath = `content/module${currentModule}/lesson${currentLesson}.html`;
  fetch(lessonFilePath)
    .then(response => {
      if (!response.ok) {
        // If the next lesson doesn't exist, move to the next module and reset the lesson number
        currentLesson = 1;
        currentModule++;
        // Check the existence of the first lesson in the next module
        return fetch(`content/module${currentModule}/lesson${currentLesson}.html`);
      }
      return response;
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`Lesson not found: ${response.status}`);
      }
      return response.text();
    })
    .then(data => {
      // Update the lesson content container with the new content
      contentDiv.innerHTML = data;
      // Update the module and lesson titles
      const moduleTitle = titles.modules[currentModule - 1].title;
      const lessonTitle = titles.modules[currentModule - 1].lessons[currentLesson - 1];
      document.querySelector('.heading-2').textContent = moduleTitle;
      document.querySelector('.sub-heading').textContent = lessonTitle;

      // Save progress
      saveProgress(currentModule, currentLesson);
    })
    .catch(error => {
      console.error('Error loading lesson:', error);
      contentDiv.innerHTML = '<p>Lesson not found. Please check the module and lesson numbers.</p>';
    });
}

  document.addEventListener('DOMContentLoaded', () => {
  fetch('get_progress.php')
    .then(response => {
      if (!response.ok) {
        throw new Error(`Error fetching progress: ${response.statusText}`);
      }
      return response.json();
    })
    .then(data => {
      currentModule = data.moduleNumber || 1;
      currentLesson = data.lessonNumber || 1;
      loadLesson(currentModule, currentLesson);

      // Update the module and lesson titles
      const moduleTitle = titles.modules[currentModule - 1].title;
      const lessonTitle = titles.modules[currentModule - 1].lessons[currentLesson - 1];
      document.querySelector('.heading-2').textContent = moduleTitle;
      document.querySelector('.sub-heading').textContent = lessonTitle;
    })
    .catch(error => {
      console.error('Error loading progress:', error);
      // Fallback to loading the first lesson if there is an error
      loadLesson(currentModule, currentLesson);
    });
});

// Updated function to handle menu clicks
function handleMenuClick(event) {
  // Prevent the default anchor behavior
  event.preventDefault();

  // Get the ID of the clicked element
  const id = event.target.id;

  // Extract moduleNumber and lessonNumber from the ID
  const match = id.match(/module(\d+)-lesson(\d+)/);
  if (match) {
    const moduleNumber = parseInt(match[1]);
    const lessonNumber = parseInt(match[2]);

    // Load the specified lesson
    loadLesson(moduleNumber, lessonNumber);

    // Update the currentLesson and currentModule
    currentLesson = lessonNumber;
    currentModule = moduleNumber;

    // Update the module and lesson titles
    const moduleTitle = titles.modules[currentModule - 1].title;
    const lessonTitle = titles.modules[currentModule - 1].lessons[currentLesson - 1];
    document.querySelector('.heading-2').textContent = moduleTitle;
    document.querySelector('.sub-heading').textContent = lessonTitle;

    // Save progress
    saveProgress(currentModule, currentLesson);
  } else {
    console.error('Invalid ID format. Expected format: "module{moduleNumber}-lesson{lessonNumber}"');
  }
}

// Add event listeners to the desktop sidebar links
document.querySelectorAll('.module-navigator .w-dropdown-link').forEach(link => {
    link.addEventListener('click', handleMenuClick);
});

// Add event listeners to the mobile menu links
document.querySelectorAll('.menumob .w-dropdown-link').forEach(link => {
    link.addEventListener('click', handleMenuClick);
});



</script>
     
          
</body>

</html> 
