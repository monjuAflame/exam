@extends('exam.layouts.master')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Edit Test</h1>

            <div class="row">

                <div class="col-12">
                    <form id="createTestForm" method="POST" action="{{ route('exam.update', $exam->id) }}">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Test Settings</h5>
                                <h6 class="card-subtitle text-muted">Followings are the basic required inputs</h6>
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible mt-3">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <i class="align-middle mr-2" data-feather="check-circle"></i> {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-12 col-md-8">
                                        <label class="form-label" for="inputExamName">Name of the exam</label>
                                        <input type="text" class="form-control" id="inputExamName"
                                               name="name" value="{{ $exam->title }}" autocomplete="off">
                                    </div>

                                    <div class="form-group col-12 col-md-4">
                                        <label class="form-label" for="inputExamDuration">Duration(in minutes)</label>
                                        <input type="number" class="form-control" id="inputExamDuration"
                                               name="duration" value="{{ $exam->duration_in_minutes }}"
                                               autocomplete="off">
                                    </div>

{{--
                                    <div class="form-group col-6">
                                        <label class="form-label" for="inputExamClass">Class or Batch</label>
                                        <div class="d-flex">
                                            <select class="form-control" name="validation-select2-multi" multiple style="width: 100%">
                                                <optgroup label="School">
                                                    <option value="class6">Class 6</option>
                                                    <option value="class7">Class 7</option>
                                                    <option value="class8">Class 8</option>
                                                    <option value="class9">Class 9</option>
                                                    <option value="class10">Class 10</option>
                                                    <option value="sscExaminees">SSC Examinees</option>
                                                </optgroup>
                                                <optgroup label="College">
                                                    <option value="1stYear">HSC First Year</option>
                                                    <option value="2ndYear">HSC Second Year</option>
                                                    <option value="HSCExaminees">HSC Examinees</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
--}}


                                    <div class="form-group col-6">
                                        <label class="form-label" for="inputExamSubject">Course</label>
                                        <div class="d-flex">
                                            <select class="form-control" name="course_id"
                                                    id="inputExamSubject">
                                                    <option value disabled selected>Choose One</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}" {{ $exam->course_id==$course->id ? 'selected' : '' }}>{{ $course->name }}</option>                                                    
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="form-label" for="inputPassingScore">Passing Score</label>
                                        <input type="number" class="form-control" id="inputPassingScore"
                                               name="passing_score" value="{{ $exam->passing_score }}"
                                               autocomplete="off">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputExamDescription">Exam Description</label>
                                        <textarea name="intro_text" class="form-control" id="inputExamDescription"
                                                   rows="3">{{ $exam->intro_text }}</textarea>
                                    </div>

                                </div>
                            </div>
{{--
                            <hr class="mx-3 my-0 bg-secondary">

                            <div class="card-header">
                                <h5 class="card-title">Question Settings</h5>
                                <h6 class="card-subtitle text-muted">These will be applied to the question paper</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-12 col-md-6 mb-0">
                                        <label class="form-label" for="inputExamQuestionShow">Show questions(for
                                            students)</label>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio d-inline-block mr-3">
                                                <input name="validation-radios-custom" type="radio"
                                                       class="custom-control-input" id="inputExamQuestionShow">
                                                <span class="custom-control-label">All questions at a time</span>
                                            </label>
                                            <label class="custom-control custom-radio d-inline-block">
                                                <input name="validation-radios-custom" type="radio"
                                                       class="custom-control-input" id="inputExamQuestionShow">
                                                <span class="custom-control-label">One question per screen</span>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-12 col-md-6 mb-0">
                                        <label class="form-label" for="inputExamQuestionRandomize">Randomize
                                            Questions</label>
                                        <br>
                                        <label class="custom-control custom-checkbox d-block">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="validation-checkbox-custom" id="inputExamQuestionRandomize">
                                            <span class="custom-control-label">Yes, Randomize</span>
                                        </label>
                                    </div>

                                </div>
                            </div>
--}}

                            <hr class="mx-3 my-0 bg-secondary">

                            <div class="card-header">
                                <h5 class="card-title">Other Settings</h5>
                                <h6 class="card-subtitle text-muted">Fill these up for the after exam actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-12">
                                        <label for="inputConclusionMsg">Conclusion Message</label>
                                        <textarea name="conclusion_text" type="text" class="form-control" id="inputConclusionMsg"
                                                  rows="3">{{ $exam->conclusion_text }}</textarea>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputPassMsg">Custom message for passed</label>
                                        <textarea name="pass_message" type="text" class="form-control" id="inputPassMsg"
                                                   rows="3">{{ $exam->pass_message }}</textarea>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputFailMsg">Custom message for failed</label>
                                        <textarea name="fail_message" type="text" class="form-control" id="inputFailMsg"
                                                 rows="3">{{ $exam->fail_message }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{--<a href="single-test.php" class="btn btn-primary">Create Test</a>--}}
                        <button type="submit" form="createTestForm" class="btn btn-primary">Update Test</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection