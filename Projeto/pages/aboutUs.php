<?php
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/common.tpl.php');

    $session = new Session();

    drawHeader($session);
    drawLogo();
?>
    <div id="menu">
        <link rel="stylesheet" href="../css/style.css">
        <h2>About Us</h1>
        <p>Have burning questions about love? Our interactive Q&A section allows you to submit your queries and receive personalized responses from our team of relationship experts. Gain valuable advice tailored to your specific situation and make informed decisions in matters of the heart.</p>
        <p>At Loving and Learning, we celebrate diversity and inclusivity. Our content embraces different perspectives and experiences, acknowledging that love transcends boundaries and preferences. We strive to create a supportive community where everyone can find guidance and inspiration on their unique love journey.</p>
        <p>Join us at Loving and Learning and embark on a path of self-discovery and growth in love and relationships. Let us be your trusted companion as you navigate the beautiful complexities of the heart.</p>
    </div>
<?php
    drawFooter();
?>
