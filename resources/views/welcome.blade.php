<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		</script>
        <title>Cube Sum Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #444;
                font-family: 'Arial', sans-serif;
                font-weight: 100;
                
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
           
            <div class="content">
                <div class="">
                    Cube Summation Laravel Test					
                </div>			
				<ul>
				  @foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				  @endforeach
				</ul>		
				
				<form action="http://<?=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>solve" method="POST" action="solve">
					<div class="table">
						<div class="fields-container">
							<div class="field input-text">
								<label><u>Type your input</u></label>								
								<textarea type="text" name="inputt" cols='30' rows='10' required ><?php if(isset($_GET['inputt'])) echo $_GET['inputt']?></textarea>
							</div>							
						</div>
					</div>				
					<div class="table">
						<div class="edit-fields">
							<div class="inline save"><input name="send" id="btn_sav" type="submit" value ="Solve!" class="redondeoboton"/></div>
						</div>
					</div>
				</form>
				@if(isset($results))
				<div class="m-b-md"></div> 
				<table width="100%" border="3" align="center" class="Estilo4" >
				  <tr>
					<th scope="col" align="center">Input</th>
					<th scope="col" align="center">Results</th>
				  </tr>					
				  <tr>					
					<td scope="col" align="center">{{ $inputt }}</td>  
					<td scope="col" align="center">{{ $results }}</td> 
				  </tr>
				</table-->	
				@endif 	
				<p align="left" >
					You are given a 3-D Matrix in which each block contains 0 initially. The first block is defined by the coordinate (1,1,1) and the last block is defined by the coordinate (N,N,N). There are two types of queries.
					<br><br>
					UPDATE x y z W<br>
					updates the value of block (x,y,z) to W.<br><br>

					QUERY x1 y1 z1 x2 y2 z2<br>
					calculates the sum of the value of blocks whose x coordinate is between x1 and x2 (inclusive), y coordinate between y1 and y2 (inclusive) and z coordinate between z1 and z2 (inclusive).
					<br><br>
					Input Format <br>
					The first line contains an integer T, the number of test-cases. T testcases follow. <br>
					For each test case, the first line will contain two integers N and M separated by a single space. <br>
					N defines the N * N * N matrix. <br>
					M defines the number of operations. <br>
					The next M lines will contain either<br><br>

					 1. UPDATE x y z W<br>
					 2. QUERY  x1 y1 z1 x2 y2 z2<br> 
					Output Format <br>
					Print the result for each QUERY.<br><br>

					Constrains <br>
					1 - T - 50 <br>
					1 - N - 100 <br>
					1 - M - 1000 <br>
					1 - x1 - x2 - N <br>
					1 - y1 - y2 - N <br>
					1 - z1 - z2 - N <br>
					1 - x,y,z - N <br>
					-10e9 - W - 10e9<br><br>
					
					Explanation <br>
					First test case, we are given a cube of 4 * 4 * 4 and 5 queries. Initially all the cells (1,1,1) to (4,4,4) are 0. <br>
					UPDATE 2 2 2 4 makes the cell (2,2,2) = 4 <br>
					QUERY 1 1 1 3 3 3. As (2,2,2) is updated to 4 and the rest are all 0. The answer to this query is 4. <br>
					UPDATE 1 1 1 23. updates the cell (1,1,1) to 23. QUERY 2 2 2 4 4 4. Only the cell (1,1,1) and (2,2,2) are non-zero and (1,1,1) is not between (2,2,2) and (4,4,4). So, the answer is 4. <br>
					QUERY 1 1 1 3 3 3. 2 cells are non-zero and their sum is 23+4 = 27.
					</p>
							
            </div>
			
			
        </div>
    </body>
</html>
