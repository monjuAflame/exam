            <h5 class="mt-4 text-capitalize">Other Academic Information</h5>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card border-0 bg-white shadow-sm p-3 my-2">
                    @php 
                    $academic_info = json_decode($student->studentProfile->academic_info);
   
                    @endphp
                    @foreach($academic_info as $acad_info)
                        <h5 class="text-capitalize"></h5>
                        <div class="border rounded-lg p-3">
                            <p>
                            Institution: <span class="text-muted">{{$acad_info->name}}</span>
                            </p>
                            <p>Board: <span class="text-muted">{{$acad_info->board}}</span></p>
                            <p>Group: <span class="text-muted">{{$acad_info->group}}</span></p>
                            <p>Passing Year: <span class="text-muted">{{$acad_info->passing_year}}</span></p>
                            <p>GPA: <span class="text-muted">{{$acad_info->result}}</span></p>
                            <p>Roll: <span class="text-muted">{{$acad_info->exam_id}}</span></p>
                        </div>
                    @endforeach
                    </div>
                </div>
               {{--- <div class="col-12 col-md-6">
                    <div class="card border-0 bg-white shadow-sm p-3 my-2">
                        <h5 class="text-capitalize">HSC</h5>
                        <div class="border rounded-lg p-3">
                            <p>Institution</p>
                            <p>Board</p>
                            <p>Group</p>
                            <p>Passing Year</p>
                            <p>GPA</p>
                            <p>Roll</p>
                        </div>
                    </div>
                </div>---}}
            </div>
