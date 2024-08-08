<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/common.tpl.php');

    $session = new Session();

    drawHeader($session);
    drawLogo();

    $db = getDatabaseConnection();
?>
    <div id="menu">
        <link rel="stylesheet" href="../css/style.css">
        <h2>FAQ</h2>
        <section id="conteudo">
            <label for="faq1">How do I create an account?</label>
            <input type="checkbox" id="faq1">
            <div id="mostra1">
                You just have to register by clicking on the register button on the right and follow the steps
            </div><br></br>
            <label for="faq3">Can I change my username?</label>
            <input type="checkbox" id="faq3">
            <div id="mostra3">
                Yes u can! You just have to go to your profile page and edit your profile
            </div><br></br>
            <label for="faq4">What is the purpose of this website?</label>
            <input type="checkbox" id="faq4">
            <div id="mostra4">
                This website is an easy way to get answers about your love problems. But if you want to know more, just go to our About Us section
            </div><br></br>
            <label for="faq5">How can I add new tickets?</label>
            <input type="checkbox" id="faq5">
            <div id="mostra5">
                You need to go to your profile page and click on the new ticket button
            </div><br></br>
            <label for="faq6">Can I cancel or modify my ticket after it has been placed?</label>
            <input type="checkbox" id="faq6">
            <div id="mostra6">
                No but maybe in the future we'll add that functionality
            </div><br></br>
            <label for="faq7">Can I customize my user profile on the website?</label>
            <input type="checkbox" id="faq7">
            <div id="mostra7">
                Yes u can! You just have to go to your profile page and edit your profile
            </div><br></br>
            <label for="faq8">Are there any age restrictions for accessing certain parts of the website?</label>
            <input type="checkbox" id="faq8">
            <div id="mostra8">
                No, every part of our website is available for everyone
            </div><br></br>
            <label for="faq9">Can I share content from the website on social media?</label>
            <input type="checkbox" id="faq9">
            <div id="mostra9">
                Of course you can! Please share our amazing website with everyone
            </div><br></br>
            <label for="faq10">How frequently is the website updated with new content?</label>
            <input type="checkbox" id="faq10">
            <div id="mostra10">
                The website is in constant updating because people all over the world sumbit their tickets
            </div><br></br>

        </section>    
    </div>
<?php
    drawFooter();
?>
