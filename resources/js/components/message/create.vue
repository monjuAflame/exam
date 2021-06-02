<template>
<div class="message">
  
  <div class="card" v-if="!editmode">
    <div class="card-header">Create Message</div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <label for="m_sending_type">Message Sending Type</label>
              <select name="m_sending_type" v-model="m_s_type" @change="message_send_type" class="form-control">
                <option v-for="(m_sending_type,index) in m_sending_types" :value="index">{{ m_sending_type }}</option>
              </select>
            </div>
            <div class="col-md-3" v-show="student_ID">
              <fieldset>
                <label for="student_id">Student ID</label><br />
                <input type="text" class="form-control" name="student_id" id="student_id" v-model="form.student_id">
              </fieldset>
            </div>
            <div class="col-md-3" v-show="course_select">
              <fieldset>
                <label for="course_id">Select Course</label><br />
                <select v-model="form.course_id" class="form-control" id="course_id" @change="getBatch()">
                  <option disabled selected value="">All</option>
                  <option v-for="course in courses" :value="course.id" >{{ course.name }}</option>
               </select>
              </fieldset>
            </div>
            <div class="col-md-3" v-show="batch_select">
              <fieldset>
                <label for="Batch_id">Select Batch</label><br />
                <select name="Batch_id" id="batch_id" v-model="form.batch_id" class="form-control">
                  <option disabled selected value="">All</option>
               </select>
              </fieldset>
            </div>
            <div class="col-md-3" v-show="year">
              <fieldset>
                <label for="year">Year</label><br />
                <input type="text" class="form-control" name="year" id="year" v-model="form.year">
              </fieldset>
            </div>
            <div class="col-md-3" v-show="add_content">
              <fieldset>
                <label for="add_content">Add Content</label><br />
                <select name="add_content" v-model="form.add_content" @change="addContentToMessage" class="form-control">
                  <option disabled selected>All</option>
                  <option value="{$name}">Student Name</option>
               </select>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="col-md-12 mt-2">
          <div class="row">
            <div class="col-md-3">
              <fieldset>
                <label for="sending_to_type">Send To</label><br />
                <select name="sending_to_type" v-model="form.send_type" class="form-control" :class="{ 'is-invalid': form.errors.has('send_type') }">
                  <option v-for="(sending_to_type, index) in sending_to_types" :value="index">{{ sending_to_type }}</option>
                </select>
                <has-error :form="form" field="send_type"></has-error>
              </fieldset>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <label for="message">Message</label>
              <span class="limiter float-right">{{charactersLeft}}</span>
              <textarea name="message" id="message" v-model="form.message" class="form-control" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
              <has-error :form="form" field="message"></has-error>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="card-footer">
      <input type="submit" :disabled="form.busy" class="btn btn-primary float-left" value="Search Information" @click="searchInformation" />
    </div>
  </div>
  <div class="card" v-if="editmode">
    <div class="card-header text-center">
      <b>Ctg Coaching</b>
      <p>SMS Preview for Confirmation</p>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th style="width:5%">SL</th>
                    <th style="width:25%">Student Name</th>
                    <th style="width:15%">Student ID</th>
                    <th style="width:10%">Mobile</th>
                    <th style="width:45%">Message</th>
                </tr>
            </thead>
              <tr v-for="(student, i) in students" :key="student.student_id">
                <td>{{++i}}</td>
                <td>{{ student.first_name }} {{student.last_name }}</td>
                <td>{{ student.student_id }}</td>
                <td>{{ student.phone }}</td>

                <td v-if="(form.message,'{$name}')!==false">{{ form.message.replace('{$name}',student.first_name) }}</td>
                <td v-else="">{{ form.message }}</td>
              </tr>
            <tbody>
            </tbody>
        </table>           
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" @click="sendMessage">Send Message</button>
    </div>
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
      m_sending_types: ["Custom SMS", "Batch Wise SMS", "Course Wise SMS", "Year Wise", "Payble Student"],
      sending_to_types: ["Student Phone"],
      student_ID: false,
      course_select: false,
      batch_select: false,
      year: false,
      add_content: false,
      m_s_type: null,
      s_to_type: null,
      courses:[],
      students:[],
      form: new Form({
        student_id: null,
        course_id: null,
        batch_id: null,
        year: null,
        add_content: null,
        send_type: null,
        message:'',
      }),
      
    };
  },
  computed: {
      charactersLeft() {
          const char = this.form.message.length;
          const  limit = 140;
          return (limit - char) + " / " + limit + " characters remaining";
      }
  },

  methods: {
      message_send_type(){
          const message_type = this.m_s_type;
          if (message_type==0) {   
              this.form.student_id = '';
              this.form.course_id = null;
              this.form.batch_id = null;
              this.form.year = null;
              this.student_ID = true;
              this.course_select = false;
              this.batch_select = false;
              this.year = false;
              this.add_content = false;
          } else if (message_type==1) {
              this.form.student_id = null;
              this.form.course_id = '';
              this.form.batch_id = '';
              this.form.year = null;
              this.course_select = true;
              this.batch_select = true;
              this.student_ID = false;
              this.year = false;
              this.add_content = true;
          } else if (message_type==2) {
              this.form.student_id = null;
              this.form.course_id = '';
              this.form.batch_id = null;
              this.form.year = null;
              this.course_select = true;
              this.student_ID = false;
              this.batch_select = false;
              this.year = false;
              this.add_content = true;
          } else if (message_type==3) {
              this.form.student_id = null;
              this.form.course_id = null;
              this.form.batch_id = null;
              this.form.year = '';
              this.year = true;
              this.student_ID = false;
              this.course_select = false;
              this.batch_select = false;
              this.add_content = false;
          } else if (message_type==4) {
              this.form.student_id = null;
              this.form.course_id = null;
              this.form.batch_id = null;
              this.form.year = null;
              this.student_ID = false;
              this.course_select = false;
              this.batch_select = false;
              this.year = false;
              this.add_content = false;
          } else { 
              this.form.student_id = null;
              this.form.course_id = null;
              this.form.batch_id = null;
              this.form.year = null;
              this.student_ID = false;
              this.course_select = false;
              this.batch_select = false;
              this.year = false;
              this.add_content = false;
          }
      },
      getCourse(){
        axios.get('/admin/messages/get/course')
                .then((data)=>{
                    this.courses = data.data;
                  })
                .catch(()=>{

                })
      },
      getBatch(){
        let course_id =  document.getElementById("course_id").value;
        let batch = document.getElementById('batch_id');
        $(batch).empty();
        axios.get('/admin/messages/get/batch/'+course_id )
                .then((data)=>{
                   $(batch).append('<option>Select</option>');
                   $.each(data.data,function(i,pro){
                        $(batch).append($('<option/>',{
                            value : pro.id,
                            text  : pro.name
                        }))
                    })
                  })
                .catch(()=>{

                })
      },
      addContentToMessage(){
        let txt = $('message');
        let caretPos = txt.selectionStart;
        let textAreaTxt = this.form.message;
        let txtToAdd = this.form.add_content;
        return this.form.message = textAreaTxt.substring(0, caretPos) + txtToAdd;
      },
      searchInformation(){
          this.form.post('/admin/messages/preview')
          .then((data)=>{
                this.editmode = true;
                this.students = data.data;
                Fire.$emit('loadData');
          })
          .catch(()=>{})
      },
      sendMessage(){
        this.form.post('/admin/messages/send')
	               .then((data)=>{
                    this.editmode = false;
                    this.form.reset();
                 })
                 .catch(()=>{
                    this.editmode = true;
                 });
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
      this.getCourse();
  }
};
</script>
<style scoped lang="scss">

</style>