@extends('exam.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><small class="mr-2">Create Questions For</small>{{ $exam->title }}</h1>
        <input type="hidden" name="course_id" id="course_id" value="{{ $exam->course_id }}">
        <input type="hidden" name="user_id" id="user_id" value="{{ $exam->user_id }}">
        <input type="hidden" name="exam_id" id="exam_id" value="{{ $exam->id }}">
        <div class="row">
            <div class="col-12" id="questionCardsHolder">
                <form>
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title text-success"><i class="align-middle mr-2" data-feather="check-circle"></i>Test Successfully
                                Created</h5>
                            <h6 class="card-subtitle text-warning"><i class="align-middle mr-2" data-feather="info"></i>Once you complete making questions, this test can be published</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-2 border rounded d-flex justify-content-between">
                                <p class="m-0 lead"><i class="align-middle mr-2 text-primary" data-feather="file-text"></i>{{ $exam->title }}</p>
                                <div>
                                    <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top"
                                       title="Edit Test"><i class="align-middle text-primary" data-feather="edit"></i></a>
                                    <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top"
                                       title="Test Settings"><i class="align-middle text-primary"
                                                                data-feather="settings"></i></a>
                                    <span class="border-right mx-2 pt-1 pb-2"></span>
                                    <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top"
                                       title="Delete Test"><i class="align-middle text-danger" data-feather="trash-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="questionCard0" data-id="0">
                        <div class="card-body">

                            <div class="form-group row question-type-selector">
                                <label class="col-form-label col-3 text-sm-right" for="questionType">Choose a question
                                    type</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <select class="custom-select flex-grow-1 question-type" id="questionType">
                                            <option value selected disabled>Choose One</option>
                                            <option value="mcq">Multiple Choice</option>
                                            <option value="writing">Written</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 question-next-actions" next-q-id="1" name="createAnotherQuestion" id="createQNext0">
                                <button type="button" class="btn btn-success mr-3 createNewQuestionButton">Save &
                                    Create Another<i class="align-middle ml-2" data-feather="corner-right-down"></i>
                                </button>
                                <a href="#" class="btn btn-danger">Save & Exit<i class="align-middle ml-2" data-feather="log-out"></i></a>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
    
@endsection