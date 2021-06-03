<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./style/editor.css">

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
			<h4>Source Code</h4>

			<select id="lang">
		        <option>Bash</option>
		        <option>C#</option>
		        <option >C++</option>
		        <option>C</option>
		        <option selected="">Java</option>
		        <option >Python</option>
		        <option>Ruby</option>
		        <option>JavaScript (Node)</option>
		    </select>
    		<textarea id="source" placeholder="Enter your code Here">class Main {
	public static void main(String args[]) {
		System.out.println("Hello world");
    }
}
</textarea>
  
  		<button id="run" onclick="run()" class="run-btn">▶️ Run (Ctrl + S)</button>
  		
		</div>

		<label for="input"><h4>Input Box</h4></label>
   		<textarea id="input" class="inputs" placeholder="Enter Input here. saperated by Enter"></textarea>

	
		<textarea readonly class="output" id="output" placeholder="Output here"></textarea>


	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script type="text/javascript">
        API_KEY = "bf5bf7ce00msh8d6e256c49ca1e5p1a2826jsne8d27a1059e8"; // Get yours for free at https://judge0.com/ce or https://judge0.com/extra-ce

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

        
        $("body").keydown(function (e) {
            if (e.ctrlKey && (e.keyCode == 83)) {
            	e.preventDefault();
                
               
                run();
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
        // console.log(myCodeMirror.getValue())

        myCodeMirror.setSize("100%","500px");
        myCodeMirror.refresh();

    </script>


</body>

</html>