<template>
  <div class="card">
    <div class="card-header">Create Question</div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <label for="question_type">Question Type</label>
          <select name="question_type" v-model="q_type" @change="question_type" class="form-control">
            <option>----</option>
            <option v-for="(question_type,index) in question_types" :value="index">{{ question_type }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <fieldset class="q_title_type" v-show="q_title_type">
            <label for="title_type">Type of Title</label><br />
            <label><input type="radio" name="title_type" id="title_type" @change="select_title_type" v-model="title_type" value="0"/> Title with Text</label><br />
            <label><input type="radio" name="title_type" id="title_type" @change="select_title_type" v-model="title_type" value="1"/> Title with Image</label>
          </fieldset>
        </div>
        <div class="col-md-4">
          <fieldset class="q_ans_type" v-show="q_ans_type">
            <label for="ans_type">Type of Answer</label><br />
            <label><input type="radio" name="ans_type" id="ans_type" @change="select_ans_type" v-model="ans_type" value="0" /> Answer with
            Option</label><br />
            <label><input type="radio" name="ans_type" id="ans_type" @change="select_ans_type" v-model="ans_type" value="1" /> Answer with Image</label>
          </fieldset>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-6" v-show="title_by_text">
          <fieldset class="title_by_text">
            <label for="title">Question Title By Text</label>
            <vue-editor
              v-model="form.question_title_text"
              :editorToolbar="customToolbar"
              id="title"
            ></vue-editor>
          </fieldset>
        </div>
        <div class="col-md-3" v-show="title_by_img">
            <label for="title">Question Title By Image</label>

          <fieldset class="title_by_img">
            <div v-if="form.question_title_image">
                <img class="img-responsive img-title" id="showPhoto" :src="getQuestionTitleImage()" alt=" "/>
            </div>
            <div v-else>
                <img class="img-responsive img-title" id="showPhoto" src="/images/user.jpg" alt=" "/>
            </div>

            <input type="file" name="question_title_image" id="question_title_image" class="img_input" accept="image/*" @change="questionTitleImage">
            <input type="button" name="browsefile" id="browsefile" class="form-control btn-browse" value="Browse" @click='updateQuestionTitleImage'>

          </fieldset>
        </div>
        <div class="col-md-3" v-show="ans_by_option">
          <label for="option">MCQ Option And Answser</label>
          <fieldset class="ans_by_option" >
            <div v-for="(question_option, k) in form.question_ans_option" :key="k">
            <div v-if="k <= 3">
              <input type="text" class="form-control" v-model="question_option.option" />
              <label>
                Answer
                <input type="radio" name="ans" id="ans" v-model="form.right_answer" :value="k"/>
              </label>
              <span>
                <button class="red" @click="remove(k)" v-show="k || (!k && form.question_ans_option.length > 1)">
                  <i class="fas fa-minus-circle white" > Remove</i>
                </button>
                <button class="green" @click="add(k)" v-show="k == form.question_ans_option.length - 1">
                  <i class="fas fa-plus-circle white" > Add</i>
                </button>
              </span>
            </div>
            <div v-else>
              <p class="red">
                <i class="fa fa-exclamation-circle red"></i> Ops ! require only four
                .
              </p>
            </div>
            </div>
          </fieldset>
        </div>
        
        <div class="col-md-3" v-show="ans_by_img">
            <label for="title">Answer By Image</label>

          <fieldset class="title_by_img">
            <div v-if="this.form.question_ans_image">
                <img class="img-responsive img-title" id="showPhoto" :src="getQuestionAnsImage()" alt=" "/>
            </div>
            <div v-else="this.form.question_ans_image">
                <img class="img-responsive img-title" id="showPhoto" src="/images/user.jpg" alt=" "/>
            </div>

            <input type="file" name="question_ans_image" id="question_ans_image" class="img_input" accept="image/*" @change="questionAnsImage">
            <input type="button" name="browsefile" id="browsefile" class="form-control btn-browse" value="Browse" @click='updateQuestionAnsImage'>

          </fieldset>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <input type="submit" class="btn btn-primary float-right" value="Create" />
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
  components: {
    VueEditor,
  },
  data() {
    return {
      editmode: false,
      loading: false,
      question_types: ["MCQ","Written"],
      ans_type: null,
      title_type: null,
      q_title_type: false,
      q_ans_type: false,
      q_type:null,
      title_by_text: false,
      title_by_img: false,
      ans_by_option: false,
      ans_by_img: false,
      q_option: false,
      form: new Form({
        question_title_text: null,
        question_title_image: null,
        question_ans_option: [{ option: "" }],
        question_ans_image: null,
        right_answer: null,
      }),
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ color: [] }, { background: [] }],
        [{ script: "sub" }, { script: "super" }],
        [{ direction: "rtl" }],
        ["code-block"],
        ["formula"],
      ],
      
    };
  },

  methods: {
      question_type(){
          const q_type = this.q_type;
          if (q_type==0) {   
              this.q_title_type = true;
              this.form.question_title_text = null;
              this.form.question_title_image = null;
              this.form.question_ans_option = null;
              this.form.question_ans_image = null;
              this.form.right_answer = null;
          } else if (q_type==1) {
              this.q_title_type = true;
              this.form.question_title_text = null;
              this.form.question_title_image = null;
              this.form.question_ans_option = null;
              this.form.question_ans_image = null;
              this.form.right_answer = null;
          } else { 
              this.q_title_type = false;
              this.q_ans_type = false;
              this.title_by_text = false;
              this.title_by_img = false;
              this.ans_by_option = false;
              this.ans_by_img = false;
              this.form.question_title_text = null;
              this.form.question_title_image = null;
              this.form.question_ans_option = null;
              this.form.question_ans_image = null;
              this.form.right_answer = null;
          }
      },
      select_title_type(){
        if (this.title_type==0) {
              this.q_ans_type = true;
              this.title_by_text = true;
              this.title_by_img = false;
              this.form.question_title_image = null; 
        } else if (this.title_type==1) {
              this.q_ans_type = true;
              this.title_by_text = false;
              this.title_by_img = true;
              this.form.question_title_text = null;  
        } else {
              this.q_ans_type = false;
              this.title_by_text = false;
              this.title_by_img = false; 
              this.form.question_title_text = null;
              this.form.question_title_image = null;
        }
      },
      select_ans_type(){
        const ans_type = this.ans_type;
        if (ans_type==0) {
           this.ans_by_option = true;
           this.ans_by_img = false;
           this.form.question_ans_option = [{ option: ''}];
           this.form.question_ans_image = null;
        } else if (ans_type==1) {
           this.ans_by_img = true;
           this.ans_by_option = false;
           this.form.question_ans_option = null;
           this.form.right_answer = null;
        } else {
            this.ans_by_option = false;
            this.ans_by_img = false;
           this.form.question_ans_option = null;
           this.form.question_ans_image = null;
           this.form.right_answer = null;
        }
      },
      updateQuestionTitleImage(){
        $('#question_title_image').click();
      },
      questionTitleImage(e){
        let file = e.target.files[0];
        // console.log(file);
        var reader = new FileReader();

        if (file['size'] < 2111775) {
            reader.onloadend = (file) => {
              // console.log('RESULT', reader.result)
              this.form.question_title_image = reader.result;
            }
            reader.readAsDataURL(file);
          
        } else {
          Swal.fire({
            type : 'error',
            title: 'Ops...',
            text:'This is larger one!'
          })
        }
      },
      getQuestionTitleImage(){
          let question_title = (this.form.question_title_image.length > 200) ? this.form.question_title_image : 'images/question/'+ this.form.question_title;
          return question_title;
      },
      updateQuestionAnsImage(){
        $('#question_ans_image').click();
      },
      questionAnsImage(e){
        let file = e.target.files[0];
        // console.log(file);
        var reader = new FileReader();

        if (file['size'] < 2111775) {
            reader.onloadend = (file) => {
              // console.log('RESULT', reader.result)
              this.form.question_ans_image = reader.result;
            }
            reader.readAsDataURL(file);
          
        } else {
          Swal.fire({
            type : 'error',
            title: 'Ops...',
            text:'This is larger one!'
          })
        }
      },
      getQuestionAnsImage(){
          let question_option = (this.form.question_ans_image.length > 200) ? this.form.question_ans_image : 'images/question/'+ this.form.question_ans_image;
          return question_option;
      },
      add() {
        
        this.form.question_ans_option.push({
            option: "",
        });
      },

      remove(index) {
      this.form.question_ans_option.splice(index, 1);
      },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
<style scoped lang="scss">

</style