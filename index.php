<html>
<head>
<title>Text manager</title>
<link rel='stylesheet' href='https://unpkg.com/mustard-ui@latest/dist/css/mustard-ui.min.css'>

</head>
<body>

<header style='height: 200px;'>
<h1>Text manager</h1>
</header>
<br>
<div class='row'>
    <div class='col col-sm-5'>
	<?php   if (isset($_POST['text'])) {
				$text= $_POST['text'];
			} else {
				$text="";
				}
			if($text=="new"){
			$_POST['keyword']='';
			} 
	?>
        <div class='panel'>
            <div class='panel-body'>
                <form method='post'>
					<h1>1. Get Text</h1>
						<input type='text' name='url' value='<?php echo isset($_POST['url']) ? $_POST['url'] : ''; ?>'>
						<button type='submit' class='button-primary' name ='text' value='new'>Fetch Text</button>
					<h1>2. Find Keyword</h1>
						<input type='text' name='keyword' value='<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : ''; ?>'>
						<button type='submit' class='button-primary'>Search Words</button>	
					<?php
if (!empty($_POST['keyword']))
  {
    echo '<h1>3. Check Result</h1>';
    $separation = preg_split('/\s+/', $_POST['keyword']);
    $content    = @file_get_contents($_POST['url']);
    if ($content === false)
      {
      }
    else
      {
		echo '<div class="stepper"> ';
		$code = 'a';
        foreach ($separation as $key)
          {	
			
			$count = 0;
            $words = explode(' ', $content);
            foreach ($words as $word)
              {
                $trimmedWord = trim($word);
                if (strlen($trimmedWord) == 0)
                  {
                    continue;
                  }
                if (strcmp($trimmedWord, $key) == 0)
                  {
                    $count += 1;
                  }
              }
            echo '<div class="step">';
            echo '<p class="step-number">' . $count . '</p> ';
			echo '<p class="step-title">Keyword : ' . $key. '</p> ';
			echo '<br>';
			echo '<p>';
			for ($i=1;$i<=$count;$i++){
				echo'<a href="#'.$code.$i.'">'.$i.'</a> ';
			}
			echo '</p>';
            echo '</div>';
			$code++;
          }
		  echo '</div>';
		 
      }
  }
?>
				</form>
            </div>
        </div>
    </div>



<div class='col col-sm-7' style='padding-left: 25px;'>
        <pre><code>
           <?php
if (empty($_POST['url']))
  {
    echo 'There are no text linked.';
  }
else
  {
    $content = @file_get_contents($_POST['url']);
    if ($content === false)
      {
        echo 'The link is not a valid text';
      }
    else
      {
		 $separation = preg_split('/\s+/', $_POST['keyword']);
		 $wordCounter = [];
		  foreach ($separation as $key){
			  $wordCounter[$key]=1;
		  }
         $words = explode(' ', $content);
            foreach ($words as $word){
			 $trimmedWord = trim($word);
			 $code ='a';
			 if (in_array($trimmedWord, $separation)){
				 foreach ($separation as $key){
				 if (strcmp($trimmedWord, $key) == 0)
                  {
					echo '<a style="background-color: #FFFF00" name="'.$code.$wordCounter[$key].'">'.$word;
				    echo '</a> ';
                    $wordCounter[$key]+=1;
                  }
				 $code++;
				 }
				 
			 }
			 else{
			 echo $word." ";
			 }
			}
      }
  }
?>
        </code></pre>
    </div>
</div>

</body>
</html>
