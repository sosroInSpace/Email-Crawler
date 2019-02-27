
<pre>
<?php

if(isset($_POST['submit'])) {

  require 'crawler.class.php';


  $url = $_POST['url'];
  $the_url = "". $url ."";
  $base = trim($url, '/');


  // If scheme not included, prepend it
  if (!preg_match('#^http(s)?://#', $base)) {
      $input = 'http://' . $base;
  }

  $urlParts = parse_url($base);
  $basename = preg_replace('/^www\./', '', $urlParts['host']);
  $the_base = "". $basename ."";

  //echo $the_base;

  $foo = new crawler($url,$the_base,2,true,true);
  $results = $foo->init();
  $string = implode("<br>", $results['emails']);

  echo "<div class='message'>Emails saved to email list.</div>";

  $myfile = fopen("email_list.txt", "a") or die("Unable to open file!");
  fwrite($myfile, "\n". $string);
  fclose($myfile);

}
  

 
?>
<style>
html,body{background:#f7c324;margin:0;color:#333;font-family:arial,sans-serif}.form-container{height:100%;width:100%;display:flex;top:0;position:absolute}.form-container>form{margin:auto;text-align:center}.form-container input[type="text"]{border:none;height:40px;width:300px;border-radius:5px;text-indent:5px;background:#f9e327;font-weight:700;color:#333}.form-container input[type="submit"]{border:none;height:40px;width:150px;border-radius:5px;text-indent:5px;background:#f9e327;color:#333;margin-top:15px;font-weight:700;text-transform:uppercase;cursor:pointer}input::placeholder{color:#333;font-weight:initial;font-size:10px}.load-wrapper{display:none;opacity:0}.load-wrap-show{display:flex;position:absolute;width:100%;height:100%;top:0;background:#ffc100;opacity:0;animation:loadshow .6s 1;animation-fill-mode:forwards}@keyframes loadshow{0%{opacity:0}100%{opacity:1}}.centered{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);display:none}.dash{margin:0 15px;width:10px;height:10px;border-radius:8px;background:#444;box-shadow:0 0 10px 0 #FECDFF;position:relative;top:8px}.uno{margin-right:-18px;transform-origin:center left;animation:spin 3s linear infinite}.dos{transform-origin:center right;animation:spin2 3s linear infinite;animation-delay:.2s}.tres{transform-origin:center right;animation:spin3 3s linear infinite;animation-delay:.3s}.cuatro{transform-origin:center right;animation:spin4 3s linear infinite;animation-delay:.4s}@keyframes spin{0%{transform:rotate(0deg)}25%{transform:rotate(360deg)}30%{transform:rotate(370deg)}35%{transform:rotate(360deg)}100%{transform:rotate(360deg)}}@keyframes spin2{0%{transform:rotate(0deg)}20%{transform:rotate(0deg)}30%{transform:rotate(-180deg)}35%{transform:rotate(-190deg)}40%{transform:rotate(-180deg)}78%{transform:rotate(-180deg)}95%{transform:rotate(-360deg)}98%{transform:rotate(-370deg)}100%{transform:rotate(-360deg)}}@keyframes spin3{0%{transform:rotate(0deg)}27%{transform:rotate(0deg)}40%{transform:rotate(180deg)}45%{transform:rotate(190deg)}50%{transform:rotate(180deg)}62%{transform:rotate(180deg)}75%{transform:rotate(360deg)}80%{transform:rotate(370deg)}85%{transform:rotate(360deg)}100%{transform:rotate(360deg)}}@keyframes spin4{0%{transform:rotate(0deg)}38%{transform:rotate(0deg)}60%{transform:rotate(-360deg)}65%{transform:rotate(-370deg)}75%{transform:rotate(-360deg)}100%{transform:rotate(-360deg)}}.centered.loader-show{display:flex}.message{position:absolute;top:0;width:100%;height:100%;display:flex}.message h3{margin:auto;color:#fdfdfd;text-transform:uppercase;font-size:27px}.blob-1{left:20%;animation:osc-l 2.5s ease infinite}.blob-2{left:80%;animation:osc-r 2.5s ease infinite;background:#262727}@keyframes osc-l{0%{left:20px}50%{left:50px}100%{left:20px}}@keyframes osc-r{0%{left:80px}50%{left:50px}100%{left:80px}}
</style>

<div class="form-container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="crawler-form">
  <h2 style="margin-bottom:0;">Email Crawler</h2>
  <input type="text" name="url" placeholder="enter url to be crawled"id="url-input"  required/>
  <input type="submit" name="submit" id="submit" />
</form>
</div>

<!-- loader -->
<div class="load-wrapper" id="load-wrapper">
<div class="container centered" id="loader">
  <div style="
    font-size: 20px;
    font-weight: bold;
    color: #444;
  ">This may take awhile</div>
  <div class="dash uno"></div>
  <div class="dash dos"></div>
  <div class="dash tres"></div>
  <div class="dash cuatro"></div>
</div>
</div>

  <script>
  (function(){var crawlerform=document.getElementById('crawler-form');crawlerform.addEventListener('submit',function(){var loader=document.getElementById('loader');var loadwrapper=document.getElementById('load-wrapper');loader.classList.add('loader-show');loadwrapper.classList.add('load-wrap-show')})})()
  </script>

 



