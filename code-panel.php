
<?php 
    echo "<script>let points = ".$_SESSION['points'].";</script>";
    echo "<script>let id = ".$_SESSION['questionId'].";</script>";

 ?>
<head>
	<title>Code Panel</title>

	<link rel="stylesheet" type="text/css" href="./style/code-panel.css">

<script src="./codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="./codemirror/lib/codemirror.css">
<!-- <script src="./codemirror/mode/javascript/javascript.js"></script> -->
<script src="./codemirror/mode/clike/clike.js"></script>
<!-- <script src="./codemirror/mode/python/python.js"></script> -->
<link rel="stylesheet" type="text/css" href="./codemirror/theme/dracula.css">
<script src="./codemirror/addon/edit/closebrackets.js"></script>
<script src="./codemirror/addon/edit/matchbrackets.js"></script>


</head>
<body>
    <form method="POST" action="test.php" name="theForm">
        <input type="hidden" name="hiddenId" id="hiddenId" >
        <input type="hidden" name="hiddenPoints" id="hiddenPoints">
    </form>
	<div class="container">
		<div class="code-area">
			<!-- <h4>Source Code</h4> -->
            <div class="top-btn">
                <input type="number" class="font-size-btn" name="font-size" max="30" min="8" id="font-size" value="18">

            <select id="lang">
                <option>Bash</option>
                <option>C#</option>
                <option >C++</option>
                <option>C</option>
                <option selected="">Java</option>
                <option >Python</option>
                <option>Ruby</option>
                
                <option>PHP</option>
                <option>TypeScript</option>

            </select>

            </div>
            

            
    		<textarea id="source" placeholder="Enter your code Here"></textarea>
  
  		<button id="run" onclick="run()" class="run-btn">▶️ Run (Ctrl + S)</button>
  		<button id="submitButton" onclick="submitProgram()" class="run-btn">✔ Submit (Ctrl + F9)</button>

		</div>

		<label for="input"><h4>Input Box</h4></label>
   		<textarea id="input" class="inputs" placeholder="Enter Input here. saperated by Enter"></textarea>

	
		<textarea readonly class="output" id="output" placeholder="Output here"></textarea>


	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script type="text/javascript">
        API_KEY = ""; // Get yours for free at https://judge0.com/ce or https://judge0.com/extra-ce

        let isSubmited = false;
        var language_to_id = {
            "Bash": 46,
            "C": 50,
            "C#": 51,
            "C++": 54,
            "Java": 62,
            "Python": 71,
            "Ruby": 72,
            "JavaScript (Node)":63,
            "Go":22,
            "PHP" : 68,
            "TypeScript" : 74,
        };

        function encode(str) {
            return btoa(unescape(encodeURIComponent(str || "")));
        }

        function decode(bytes) {
            var escaped = escape(atob(bytes || ""));
            try {
                return decodeURIComponent(escaped);
            } catch {
                return unescape(escaped);
            }
        }

        function errorHandler(jqXHR, textStatus, errorThrown) {
            $("#output").val(`${JSON.stringify(jqXHR, null, 4)}`);
            $("#run").prop("disabled", false);
            $("#submitButton").prop("disabled", false);

        }

        function check(token) {
            $("#submitButton").prop("disabled", false);
            $("#output").val($("#output").val() + "\n⏬ Checking submission status...");
            $.ajax({
                url: `https://judge0-ce.p.rapidapi.com/submissions/${token}?base64_encoded=true`,
                type: "GET",
                headers: {
                    "x-rapidapi-host": "judge0-ce.p.rapidapi.com",
	                "x-rapidapi-key": API_KEY
                },
                success: function (data, textStatus, jqXHR) {
                    if ([1, 2].includes(data["status"]["id"])) {
                        $("#output").val($("#output").val() + "\nℹ️ Status: " + data["status"]["description"]);
                        setTimeout(function() { check(token) }, 1000);
                    }
                    else {
                        var output = [decode(data["compile_output"]), decode(data["stdout"])].join("\n").trim();
                        $("#output").val(`${data["status"]["id"] != "3" ? "🔴" : "🟢"} ${data["status"]["description"]}\n${output}`);
                        $("#run").prop("disabled", false);
// checking correct submission and incrementing score
                        if(data["status"]["id"]==3 && isSubmited==true) {
                            let theForm = document.forms['theForm'];
                            $("#hiddenPoints").val(points);
                            $("#hiddenId").val(id);
                            alert("successful submission!");
                            theForm.submit();
                        }
                        isSubmited = false;
                    }
                },
                error: errorHandler
            });
        }

        function run() {

            var text = myCodeMirror.getValue(); 
                // console.log(text)
                $("#source").val(text); // copy editor content value to text area

            $('html, body').animate({    // scroll to output div
                    scrollTop: $("#output").offset().top  

                }, 1000);

            $("#run").prop("disabled", true);
            $("#submitButton").prop("disabled", true);
            $("#output").val("⚙️ Creating submission...");

            // let encodedExpectedOutput = encode($("#expected-output").val());
            
            // let encodedExpectedOutput = encode($("#expected-output").val());
            let encodedExpectedOutput = "" ;
            if(isSubmited)
            {
                // isSubmited = false;
                $("#input").val(<?php echo json_encode(str_replace("<br>","",$customInput)); ?>);
                console.log(<?php echo json_encode(str_replace("<br>","",$expectedOutput)); ?>);
                encodedExpectedOutput = encode(<?php echo json_encode(str_replace("<br>","",$expectedOutput)); ?>);
            }
            // console.log(encodedExpectedOutput);

           
            // console.log(encodedExpectedOutput);
            // $("#output").val(encodedExpectedOutput);



            if (encodedExpectedOutput === "") {
                encodedExpectedOutput = null; // Assume that user does not want to use expected output if it is empty.
            }

            $.ajax({
                url: "https://judge0-ce.p.rapidapi.com/submissions?base64_encoded=true&wait=false",
                type: "POST",
                contentType: "application/json",
                headers: {
                    "x-rapidapi-host": "judge0-ce.p.rapidapi.com",
					// "x-rapidapi-host": "judge0-extra-ce.p.rapidapi.com",
	                "x-rapidapi-key": API_KEY
                },
                data: JSON.stringify({
                    "language_id": language_to_id[$("#lang").val()],
                    "source_code": encode($("#source").val()),
                    "stdin": encode($("#input").val()),
                    "expected_output": encodedExpectedOutput,
                    "redirect_stderr_to_stdout": true
                }),
                success: function(data, textStatus, jqXHR) {
                    $("#output").val($("#output").val() + "\n🎉 Submission created.");
                    setTimeout(function() { check(data["token"]) }, 500);
                },
                error: errorHandler
            });
        }

        function submitProgram() {
            isSubmited = true;
            run();
        }
        $("body").keydown(function (e) {
            if (e.ctrlKey && (e.keyCode == 83)) {
            	e.preventDefault();
                
                alert(<?php echo json_encode($_SESSION['solved'])?>);
                console.log(<?php echo json_encode($_SESSION['points']) ?>);
                
                run();
            }
            if(e.ctrlKey && e.keyCode == 120 ) {
            	submitProgram();
            }
        });

        $("textarea").keydown(function (e) {
        	console.log(e.target.value)
            if (e.keyCode == 9) {
                e.preventDefault();
                var start = this.selectionStart;
                var end = this.selectionEnd;

                var append = "     ";
                $(this).val($(this).val().substring(0, start) + append + $(this).val().substring(end));

                this.selectionStart = this.selectionEnd = start + append.length;
            }
        });

        // $("#source").focus();


// code mirror editor 
        var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("source"),{
        	value: "hello yash",
        	lineNumbers: true,
        	mode: "text/x-java",
        	theme: "dracula",
        	autoCloseBrackets: true,
        	// autoCloseTags: true,
        	matchBrackets : true,
        	// extraKeys :{ "Ctrl-Space":"autocomplete"},
        });
        console.log(myCodeMirror.getValue());

        myCodeMirror.setSize("100%","500px");

$("#font-size").on("change",(e)=>{
    console.log(e.target.value)
    $(".CodeMirror").css("fontSize", e.target.value+'px');
});

         var sampleCode = {
            "Bash" : 'echo "Hello World"',
             "C": `#include <stdio.h>

int main() {
    //code
    return 0;
}`,
             "C#": `using System;

public class Main
{
    public static void Main()
    {
        // your code goes here
    }
}
`,
             "C++": `#include <iostream>
using namespace std;

int main() {
    cout<<"AshCode!";
    return 0;
}`,
             "Java": `import java.util.*;
class Main {
    public static void main(String args[]) {
        System.out.println("Hello world");
    }
}
`,
             "Python": `print("Hello, world!")`,
             "Ruby": `puts "Hello, world!"`,
             "Go": `package main

import "fmt"

func main() {
    fmt.Println("hello world")
}`,
             "PHP": `<?//php
// PHP code goes here
?>`,
             "TypeScript" : `let message: string = 'Hello, World!';
console.log(message);`,
         }
         $('#lang').on("change",()=>{
            myCodeMirror.setValue(sampleCode[$("#lang").val()]);
            console.log(sampleCode[$("#lang").val()]);
         })
         myCodeMirror.setValue(sampleCode["Java"]);


    </script>


</body>
