<div
    class="modal fade"
    id="semesterModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="semesterForm">

                @csrf

                <input
                    type="hidden"
                    id="semester_id">

                <div class="modal-header">

                    <h5 id="modalTitle">

                        Add Semester

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>
                            Course
                        </label>

                        <select
                            name="course_id"
                            class="form-select">

                            <option value="">
                                Select Course
                            </option>

                            @foreach($courses as $course)

                                <option value="{{ $course->id }}">

                                    {{ $course->name }}

                                </option>

                            @endforeach

                        </select>

                        <span
                            class="text-danger"
                            id="course_error">
                        </span>

                    </div>

                    <div class="mb-3">

                        <label>
                            Semester Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Semester 1">

                        <span
                            class="text-danger"
                            id="name_error">
                        </span>

                    </div>

                    <div class="mb-3">

                        <label>
                            Semester No
                        </label>

                        <input
                            type="number"
                            name="semester_no"
                            id="semester_no"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>