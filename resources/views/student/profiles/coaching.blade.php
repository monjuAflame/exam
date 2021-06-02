            <h5 class="mt-4 text-capitalize">Coaching Information</h5>
            <div class="card border-0 bg-white shadow-sm p-3 my-2">
                <p>Student ID: <span class="text-muted"> {{ $student->studentProfile->student_id }}</span></p>
                <p>Programe: <span class="text-muted">
                @php 
                $courseCategory = $courseCat->where('id', $student->enrolledCourses[0]->course_category_id)->first() @endphp
                {{ $courseCategory->name }}
                </span></p>
                <p>Course: <span class="text-muted">{{ $student->enrolledCourses[0]->name }}</span></p>
                <p>Batch: <span class="text-muted">{{ $student->enrolledBatches[0]->name }}</span></p>
                <p>Admission Type: <span class="text-muted">{{ $student->enrolledBatches[0]->pivot->admission_type }}</span></p>
                <p>Session: <span class="text-muted">{{ $student->enrolledBatches[0]->pivot->session }}</span></p>
            </div>