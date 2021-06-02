document.addEventListener("DOMContentLoaded", function () {
    // Initialize Select2 select box
    $("select[name=\"validation-select2\"]").select2({
        allowClear: true,
        placeholder: "Choose One",
    }).change(function () {
        $(this).valid();
    });
    // Initialize Select2 multiselect box
    $("select[name=\"schedule_batches\"]").select2({
        placeholder: "Select Batches",
    }).change(function () {
        $(this).valid();
    });
    // Trigger validation on tagsinput change
    $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function () {
        $(this).valid();
    });
    // Initialize validation
    $("#createTestForm").validate({
        ignore: ".ignore, .select2-input",
        focusInvalid: false,
        rules: {
            "validation-email": {
                required: true,
                email: true
            },
            "validation-password": {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            "validation-password-confirmation": {
                required: true,
                minlength: 6,
                equalTo: "input[name=\"validation-password\"]"
            },
            "validation-required": {
                required: true,
                minlength: 2
            },
            "validation-url": {
                required: true,
                url: true
            },
            "validation-select": {
                required: true
            },
            "validation-multiselect": {
                required: true,
                minlength: 2
            },
            "validation-select2": {
                required: true
            },
            "validation-select2-multi": {
                required: false,
            },
            "validation-text": {
                required: true
            },
            "validation-file": {
                required: true
            },
            "validation-radios": {
                required: true
            },
            "validation-radios-custom": {
                required: true
            },
            "validation-checkbox": {
                required: true
            },
            "validation-checkbox-custom": {
                required: true
            },
            "validation-checkbox-group-1": {
                require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
            },
            "validation-checkbox-group-2": {
                require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
            },
            "validation-checkbox-custom-group-1": {
                require_from_group: [1, "input[name=\"validation-checkbox-custom-group-1\"], input[name=\"validation-checkbox-custom-group-2\"]"]
            },
            "validation-checkbox-custom-group-2": {
                require_from_group: [1, "input[name=\"validation-checkbox-custom-group-1\"], input[name=\"validation-checkbox-custom-group-2\"]"]
            }
        },
        // Errors
        errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents(".form-group");
            // Do not duplicate errors
            if ($parent.find(".jquery-validation-error").length) {
                return;
            }
            $parent.append(
                error.addClass("jquery-validation-error small form-text invalid-feedback")
            );
        },
        highlight: function (element) {
            var $el = $(element);
            var $parent = $el.parents(".form-group");
            $el.addClass("is-invalid");
            // Select2 and Tagsinput
            if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function (element) {
            $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
        }
    });
    qTypeSelectorTrigger();
    initTinyMCE();
});




// let expTriggerCount = 0;
// function explainTrigger() {
// // Explanation Input Field
//     $('#includeExplanationTrigger').on('click', function () {
//         // Get the checkbox
//         let checkBox = document.getElementById("includeExplanationTrigger");
//         // If the checkbox is checked, display the output text
//         if (checkBox.checked == true) {
//             $('#includeExplanationHolder').removeClass('d-none');
//         } else {
//             $('#includeExplanationHolder').addClass('d-none');
//         }
//     });
// }


// Next Question Append
let idCount = 1;

function test0() {
    let deleteId = '#createQNext' + (idCount - 1);
    let buttonWithIncrementedID = '<div class="card" id="questionCard' + idCount + '" data-id="'+idCount+'">\n' +
        '                        <div class="card-body">\n' +
        '                            <div class="form-group row question-type-selector">\n' +
        '                                <label class="col-form-label col-3 text-sm-right" for="questionType">Choose a question type</label>\n' +
        '                                <div class="col-8">\n' +
        '                                    <div class="input-group mb-3">\n' +
        '                                        <select class="custom-select flex-grow-1 question-type" id="questionType">\n' +
        '                                            <option value>Choose One</option>\n' +
        '                                            <option value="mcq">Multiple Choice</option>\n' +
        // '                                            <option value="trueOrFalse">True or False</option>\n' +
        // '                                            <option value="fillBlank">Fill In The Blank</option>\n' +
        '                                            <option value="writing">Written</option>\n' +
        '                                        </select>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            <div class="mt-3 question-next-actions" name="createAnotherQuestion" next-q-id="'+(idCount+1)+'" id="createQNext' +idCount+ '">\n' +
        '                                <button type="button" class="btn btn-success mr-3 createNewQuestionButton">Save &\n' +
        '                                    Create Another<i class="align-middle ml-2" data-feather="corner-right-down"></i>\n' +
        '                                </button>\n' +
        '                                <a href="#" class="btn btn-danger">Save & Exit<i class="align-middle ml-2"\n' +
        '                                                                                 data-feather="log-out"></i></a>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>';

    $("#questionCardsHolder form").append(buttonWithIncrementedID);
    $(deleteId).addClass('d-none');
    idCount++;
    feather.replace();
    qTypeSelectorTrigger();
    initTinyMCE();
    document.querySelectorAll('.createNewQuestionButton').forEach(button => button.addEventListener('click', function(){
        saveQuestion(idCount)
    }), false);

}
function saveQuestion(id){
    // console.log(id)

    let qId = $("form").find('.mcq-set'+id).attr('mcq-set-id');
    if(id==qId)
    {
        
        let questionTitle = $("#questionTitle"+qId).text();
    
        let options = $(".question-mcq-choices"+qId).find('p');
        let questionOption = $.map(options, e => $(e).text());

        let ans = $(".question-mcq-choices"+qId).find('input[name="mcq_answer_index"]:checked');
        
        let mcq_answer_index = ans.val();
        

        let questionMark = $("#questionMcqIndivMarks"+qId).val();

        let questionType = $("#questionType").val();
        let questionExplation = $("#inputExplanationMsg"+qId).val();
        let course_id = $("#course_id").val();
        let user_id = $("#user_id").val();
        let exam_id = $("#exam_id").val();
        
        let data = {type:questionType,title:questionTitle,options:questionOption,mark:questionMark,explanation:questionExplation,course_id:course_id,user_id:user_id,exam_id:exam_id,mcq_answer_index:mcq_answer_index};
        // console.log(data)
        if(questionMark == null)
        {
            alert("Please Give Question Mark");
        } else if(ans.val() == null)
        {
            alert("Please Select a Answer");
        } else {
            $.ajax({
                url: "/admin/questions/create",
                type: "post",
                data: data,
                success: function (response) {
                    test0();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        
    } else {
        return "error";
    }
    
    

}
let button = document.querySelectorAll('.createNewQuestionButton').forEach(button => button.addEventListener('click', function(){
    saveQuestion(1);
}, false));

// console.log(button.length);
// for(let i = 0; i < button.length; i++){
//     button[i].addEventListener('click', function(){saveQuestion(i)},false);
// }

let qCardIDInit = 0;
function qTypeSelectorTrigger() {


    // Script Question Number Auto Increment
    let qCardId = "questionCard" + qCardIDInit;
    let qNumber = document.getElementById(qCardId);
    let qSequence = parseInt(qNumber.getAttribute('data-id')) + 1;


    let qCardID = "#questionCard" + qCardIDInit + " " + ".question-type-selector";
    let qTypeDir = "#questionCard" + qCardIDInit + " " + "select.question-type";
    let mcqDir = "#questionCard" + qCardIDInit + " " + ".mcq-set";
    let trueFalseDir = "#questionCard" + qCardIDInit + " " + ".true-false-set";
    let fillBlankDir = "#questionCard" + qCardIDInit + " " + ".fill-blank-set";
    let writingDir = "#questionCard" + qCardIDInit + " " + ".writing-set";
    let explainAppendID = "includeExplanationTrigger" + qCardIDInit;
    $(qTypeDir).change(function () {
        let mcqSet = `    <div class="mcq-set${qSequence}" mcq-set-id="${qSequence}">
                                <div class="question-mcq-individual d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-start">
                                        <span class="font-weight-bolder text-dark lead mr-4">Q.${qSequence}</span>
                                        
                                        <div class="clearfix">
                                            <p class="full-featured-non-premium m-0 font-weight-bolder text-dark lead" id="questionTitle${qSequence}">What is the capital of Bangladesh?</p>
                                        </div>
                                        
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label for="questionMcqIndivMarks" class="mr-2">Marks</label>
                                        <input type="number" id="questionMcqIndivMarks${qSequence}" class="form-control mb-2"
                                               style="max-width: 120px;" required>
                                    </div>
                                </div>

                                <div class="question-mcq-choices${qSequence}">
                                    <div class="d-flex align-items-center flex-start mx-5 my-3">
                                        <input type="radio" name="mcq_answer_index" value="1" id="mcq_answer_index${qSequence}" class="align-middle mr-2">
                                        <p class="full-featured-non-premium m-0 text-dark ">This a choice</p>
                                    </div>
                                    <div class="d-flex align-items-center flex-start mx-5 my-3">
                                        <input type="radio" name="mcq_answer_index" value="2" id="mcq_answer_index${qSequence}" class="align-middle mr-2">
                                        <p class="full-featured-non-premium m-0 text-dark">This a choice</p>
                                    </div>
                                    <div class="d-flex align-items-center flex-start mx-5 my-3">
                                        <input type="radio" name="mcq_answer_index" value="3" id="mcq_answer_index${qSequence}" class="align-middle mr-2">
                                        <p class="full-featured-non-premium m-0 text-dark">This a choice</p>
                                    </div>
                                    <div class="d-flex align-items-center flex-start mx-5 my-3">
                                        <input type="radio" name="mcq_answer_index" value="4" id="mcq_answer_index${qSequence}" class="align-middle mr-2">
                                        <p class="full-featured-non-premium m-0 text-dark">This a choice</p>
                                    </div>
                                </div>

                                <div class="form-group d-inline-block">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="includeExplanationTrigger${qSequence}">
                                        <span class="custom-control-label">Include Explanation</span>
                                    </label>
                                </div>
                                <div id="includeExplanationHolder${qSequence}" class="form-group col-12 d-none">
                                    <label for="inputExplanationMsg" class="sr-only">Explanation</label>
                                    <textarea type="text" class="form-control" id="inputExplanationMsg${qSequence}"
                                              placeholder="Enter a test explanation" rows="3"></textarea>
                                </div>
                          </div>`;
//        let trueFalseSet = ``;
//        let fillBlankSet = ``;
        let writingSet = `<div class="writing-set">
                                <div class="question-fib-individual d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-start">
                                        <span class="font-weight-bolder text-dark lead mr-4">Q.${qSequence}</span>
                                        
                                        <div class="clearfix">
                                            <p class="full-featured-non-premium m-0 font-weight-bolder text-dark lead">What is the capital of Bangladesh?</p>
                                        </div>
                                        
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label for="questionMcqIndivMarks" class="mr-2">Marks</label>
                                        <input type="number" id="questionMcqIndivMarks${qSequence}" class="form-control mb-2"
                                               style="max-width: 120px;" required>
                                    </div>
                                </div>
                                
                                <div class="form-group d-inline-block">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="includeExplanationTrigger${qSequence}">
                                        <span class="custom-control-label">Include Explanation</span>
                                    </label>
                                </div>
                                <div id="includeExplanationHolder${qSequence}" class="form-group col-12 d-none">
                                    <label for="inputExplanationMsg" class="sr-only">Explanation</label>
                                    <textarea type="text" class="form-control" id="inputExplanationMsg${qSequence}"
                                              placeholder="Enter a test explanation" rows="3"></textarea>
                                </div>
                          </div>`;
        let selectedQType = $(this).children("option:selected").val();
        if (selectedQType === 'mcq') {
            $(trueFalseDir).remove();
            $(fillBlankDir).remove();
            $(writingDir).remove();
            $(qCardID).after(mcqSet);
            initTinyMCE();
        } else if (selectedQType === 'trueOrFalse') {
            $(mcqDir).remove();
            $(fillBlankDir).remove();
            $(writingDir).remove();
            $(qCardID).after(trueFalseSet);
        } else if (selectedQType === 'fillBlank') {
            $(mcqDir).remove();
            $(trueFalseDir).remove();
            $(writingDir).remove();
            $(qCardID).after(fillBlankSet);
        } else if (selectedQType === 'writing') {
            $(mcqDir).remove();
            $(trueFalseDir).remove();
            $(fillBlankDir).remove();
            $(qCardID).after(writingSet);
            initTinyMCE();
        } else {
            $(mcqDir).remove();
            $(trueFalseDir).remove();
            $(fillBlankDir).remove();
            $(writingDir).remove();
        }
        feather.replace();
        explainTrigger();
    });
    qCardIDInit++;


    // Explanation Input Field
    function explainTrigger() {
        $("#includeExplanationTrigger"+qSequence).on('click', function () {
            // Get the checkbox
            let checkBox = document.getElementById("includeExplanationTrigger"+qSequence);
            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                $("#includeExplanationHolder"+qSequence).removeClass('d-none');
            } else {
                $("#includeExplanationHolder"+qSequence).addClass('d-none');
            }
        });
    }
}






//
// let tinyBoo = ".mcq-set" + " " + "p";
// function BooToo(){
//     $(tinyBoo).click(function(){
//         initTinyMCE();
//     });
// }








// Script For TinyMCE


let tinyCount = 0;



function initTinyMCE() {
    let tinySelector = 'textarea#full-featured-non-premium'+tinyCount;

    let useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    tinymce.init({
        selector: '.full-featured-non-premium',
        menubar: false,
        inline: true,
        plugins: 'paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars',
        imagetools_cors_hosts: ['picsum.photos'],
        toolbar: ['undo redo | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify', 'outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap emoticons | fullscreen  preview save print | insertfile image media link codesample | ltr rtl'],
        toolbar_sticky: false,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 600,
        image_caption: false,
        quickbars_selection_toolbar: false,
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    tinyCount++;
}
