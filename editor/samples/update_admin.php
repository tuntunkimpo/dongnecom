<?php
	require("../../config/session.php");
	require("../../config/config.php");
	require("../../lib/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
?>
<!DOCTYPE html>
<html lang="en">
	<header>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>동네컴퓨터학원</title>
		<script src="../ckeditor.js"></script>
		<script src="js/sample.js"></script>
		<link rel="stylesheet" href="css/samples.css">
		<link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="../css/fontello.css">
		<script>
		// 재료 사진 조회 
            $(document).ready(function () {
                $("#keyword").keyup(function()   {
                    var keyword = $(this).val();
                    var dataString = 'searchword='+ keyword;                
                                
                    if(keyword=='') { 
                         
                         $("#display").hide();

                    } else {    
                        $.ajax({
                        type: "POST",
                        url: "itemssuggestions.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {               
                            $("#display").html(html).show(); 
                            
                            $("#key").click(function(){
                                $("#display").hide();
                                $("#play").html(html).show(); 
                            });
                          
                            }
                        });
                    } return false;                             
                });     
            }); 
     
        </script>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</header>
	<body>
		<div class="container">			
			<div class="page-header">
			<a href="../../index.php"></a>
				<h1>프로젝트 수정</h1>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" name="formUploadFile" id="uploadForm" action="upload-update_admin.php">
						<?php
							$id = $_GET['id'];
							$sql = "SELECT * FROM ck LEFT JOIN userfiles ON ck.id = userfiles.editorid WHERE ck.id='{$id}'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_array($result);

							if($result === false){
									echo mysqli_error($conn);
									exit;
							}
							echo $id;
						?>	
						
						<p>
						<h3>제목</h3>
							<input type="hidden" name="editorid" value="<?=$id?>">
							<input type="text" name="title" value="<?=$row['title']?>">	

						</p>
						<p>
						<h3>메인사진</h3>	
							<input type="file" name="maintitle">
							<img src="../../editor/samples/Upload/<?=$row['title_img_name']?>" style="width:20rem"alt="">	
						</p>
						<p>
							<textarea class="ckeditor" name="editor"><?=$row['content']?></textarea>	
							<!-- <button type="submit" name="submit">UPLOAD</button> -->
						</p>
						<div class="form-group">
							<!-- <label for="exampleInputFile">재료:</label>
							<p>
							<img src="../../PHPMySqlFileUpload/samples/Upload/<?=$row['FileName']?>" style="width:20rem"alt="">	
							<input type="file" id="exampleInputFile" name="files[]" multiple="multiple">
							<img src="../../PHPMySqlFileUpload/samples/Upload/<?=$row['FileName']?>" style="width:20rem"alt="">	
							<input type="file" id="exampleInputFile" name="files[]" multiple="multiple">
							</p> -->
							<!-- <p class="help-block"><span class="label label-info">Note:</span> Please, Select the only images (.jpg, .jpeg, .png, .gif) to upload with the size of 100KB only.</p> -->
						</div>	
						<div class="input-group">
							<input name="keyword" id="keyword" type="text" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="button" onclick="javascript:checkSearch('keyword');">검색</button>
							</span>
						</div>
						<div id="display"></div>
						<div id="play"></div>	
						
						<button type="submit" class="btn btn-primary" name="btnSubmit" >전송</button>
						<!-- <a href="view.php" class="btn btn-info">Show Uploaded Files</a> -->
					</form>
					<br/>
					<!-- <label for="Progressbar">Progress:</label>
					<div class="progress" id="Progressbar">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="divProgressBar">
							<span class="sr-only">45% Complete</span>
						</div>						
					</div>
					<div id="status"> -->
					</div>
				</div>
			</div>
		
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
		<script src="js/jQuery.Form.js"></script>
		
		<script type="text/javascript">
			// $(document).ready(function(){			
				
			// 	var divProgressBar=$("#divProgressBar");
			// 	var status=$("#status");
				
			// 	$("#uploadForm").ajaxForm({
					
			// 		dataType:"json",
					
			// 		beforeSend:function(){
			// 			divProgressBar.css({});
			// 			divProgressBar.width(0);
			// 		},
					
			// 		uploadProgress:function(event, position, total, percentComplete){
			// 			var pVel=percentComplete+"%";
			// 			divProgressBar.width(pVel);
			// 		},
					
			// 		complete:function(data){
			// 			status.html(data.responseText);
			// 		}
			// 	});
			// });
		</script>
	</body>
</html>