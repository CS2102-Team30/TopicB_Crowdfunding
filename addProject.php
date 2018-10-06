<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
         <?php include("./template/head.php"); ?>
    </head>
    
    <body>
        <?php
            //check if logged out
            include_once("./phpFunctions/checkLogOut.php");
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>

        <div class="container">
            <div class="text-center">
                <br>
                <h1>Have an idea? <br>Let's get started right here. </h1>
                <br>
            </div>

            <form action="phpFunctions/processAdd.php" method="POST">
                <div class="form-group row">
					<div class="col-lg-1"></div>
                    <label for="title" class="col-lg-2 col-form-label">Project Title:</label>
                    <div class="col-lg-8">
                        <input name="title" class="form-control" placeholder="Title" required/>
                    </div>
					<div class="col-lg-1"></div>
                </div>
                <div class="form-group row">
					<div class="col-lg-1"></div>
                    <label for="description" class="col-lg-2 col-form-label">Project Description:</label>
                    <div class="col-lg-8">
                        <textarea name="description" class="form-control" placeholder="Description" rows="5" required></textarea>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <div class="form-group row">
					<div class="col-lg-1"></div>
                    <label for="amount_sought" class="col-lg-2 col-form-label">Amount of funding sought:</label>
                    <div class="col-lg-8">
                        <input name="amount_sought" class="form-control" placeholder="Amount" type="number" min="1" max = "2147483647" required/>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <div class="form-group row">
					<div class="col-lg-1"></div>
                    <label for="duration" class="col-lg-2 col-form-label">Project Duration (number of days):</label>
                    <div class="col-lg-8">
                        <input name="duration" class="form-control" placeholder="Duration" type="number" min="1" max = "2147483647" required/>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <div class="form-group row">
					<div class="col-lg-1"></div>
                    <label for="keywords" class="col-lg-2 col-form-label">Keywords</label>
                    <div class="col-lg-8">
                        <input name="keywords" class="form-control" placeholder="Keywords"/>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit" name="project_submit">Confirm Project Submission</button>
                </div>
            </form>
            <div class="text-center">
            <?php
                if(isset($_SESSION['submit_state'])) {
                    if ($_SESSION['submit_state'] == "failed") {
                        echo "Project submission failed, please try again";
                        $_SESSION['submit_state'] = "";
                    }
                    else if ($_SESSION['submit_state'] == "success"){
                        echo "Project successfully submitted";
                        $_SESSION['submit_state'] = "";
                    }else{}
                }
            ?>
            </div>
        </div>
    </body>
</html>