<?php

namespace App\Traits;
use App\Models\StudentGroupWiseMark;
use App\Models\StudentCourseWiseMark;
use App\Models\EnrollmentCourse;
use App\Models\StudentMark;
use App\Models\StudentMarkDetail;

trait StudentMarkGroupable {
    public static function setConvertedMark($enrollment_course_id) {

        $enrollment_course = EnrollmentCourse::with([])->find($enrollment_course_id);
        $enrollment_groups = $enrollment_course->enrollment_component_groups;
       
        $students = [];
        $group_max_marks = [];
        $group_final_marks = [];

        foreach ($enrollment_groups as $enrollment_group) {
            $enrollment_group_id = $enrollment_group->id;
            $type_count = $enrollment_group->enrollment_component_types->count();
            $type_max_mark = $enrollment_group->enrollment_component_types->sum("maximum_mark");

            $contribution_percentage = $enrollment_group->contribution_percentage;
            $group_max_marks[$enrollment_group_id]["contribution_percentage"] = $contribution_percentage;
            $group_max_marks[$enrollment_group_id]["type_count"] = $type_count;
            $group_max_marks[$enrollment_group_id]["type_max_mark"] = $type_max_mark;
        }

        $student_marks = StudentMark::with([])->where("enrollment_course_id", $enrollment_course_id)->get();
        foreach ($student_marks as $student_mark) {
            $student_mark_details =  $student_mark->student_mark_details;
            $enrollment_component_group_id = $student_mark->enrollment_component_type->enrollment_component_group->id;
            $academic_component_category_id = $student_mark->enrollment_component_type->enrollment_component_group->academic_component_group->academic_component_category->id;
            
            $contribution_percentage = $group_max_marks[$enrollment_component_group_id]["contribution_percentage"];
            $type_count = $group_max_marks[$enrollment_component_group_id]["type_count"] ;
            $type_max_mark = $group_max_marks[$enrollment_component_group_id]["type_max_mark"];

            foreach ($student_mark_details as $student_mark_detail) {                
                $student_mark_detail_mark = $student_mark_detail["mark"];
                $student_id = $student_mark_detail['student_id'];
                
                // For Testing Pupose
                // $students[$student_id][$enrollment_component_group_id]['student_name'] = $student_mark_detail->student->title;
                // $students[$student_id][$enrollment_component_group_id]['type_name'][] = $student_mark->enrollment_component_type->academic_component_type->title;
                // $students[$student_id][$enrollment_component_group_id]['group_name'] = $student_mark->enrollment_component_type->enrollment_component_group->academic_component_group->title;
                // $students[$student_id][$enrollment_component_group_id]['type'][] = $student_mark->enrollment_component_type->id;
                
                if(empty($student_mark_detail["is_absent"])) {

                    $mark = ($students[$student_id][$enrollment_component_group_id]['mark'] ?? 0) + $student_mark_detail_mark;
                    
                   //Start Student Mark Group Wise
                    $converted_mark = round( ( $mark/$type_max_mark ) * $contribution_percentage , 2);

                    $converted_mark_individual = round( ( $student_mark_detail_mark/$type_max_mark ) * $contribution_percentage , 2);
                    
                    $students[$student_id][$enrollment_component_group_id]['mark'] =  $mark;

                    $students[$student_id][$enrollment_component_group_id]['converted_mark'] =  $converted_mark;
                    //End Student Mark Group Wise
                    
                    //Start Student Mark Course Wise
                    $final_mark = ($group_final_marks[$student_id][$enrollment_course_id]['final'] ?? 0) + $converted_mark_individual;
                    $group_final_marks[$student_id][$enrollment_course_id]['final'] =  $final_mark;

                    switch ($academic_component_category_id) {
                        case config('settings.academic_component_category')["internal"]:
                            $internal_mark = ($group_final_marks[$student_id][$enrollment_course_id]['internal'] ?? 0) + $converted_mark_individual;
                            $group_final_marks[$student_id][$enrollment_course_id]['internal'] =  $internal_mark;
                            $group_final_marks[$student_id][$enrollment_course_id]['marks']['internal'][] =  $converted_mark_individual;
                        break;
                        case config('settings.academic_component_category')["external"]:
                            $external_mark = ($group_final_marks[$student_id][$enrollment_course_id]['external'] ?? 0) + $converted_mark_individual;
                            $group_final_marks[$student_id][$enrollment_course_id]['external'] =  $external_mark;
                            $group_final_marks[$student_id][$enrollment_course_id]['marks']['external'][] =  $converted_mark_individual;
                        break;
                    }
                    //End Student Mark Course Wise
                }
                
            }
        }

        foreach($students as $student_id =>  $student) {
            //Start Student Mark Group Wise
            foreach ($student as $enrollment_component_group_id => $enrollment_component_group) {
                $converted_mark = $enrollment_component_group["converted_mark"] ?? 0;
                StudentGroupWiseMark::updateOrCreate(["student_id" => $student_id, "enrollment_component_group_id" => $enrollment_component_group_id] , ["converted_mark" => $converted_mark]);
            }
            //End Student Mark Group Wise

            //Start Student Mark Course Wise
            $internal_mark = $group_final_marks[$student_id][$enrollment_course_id]['internal'] ?? null;
            $external_mark = $group_final_marks[$student_id][$enrollment_course_id]['external'] ?? null;
            $final_mark = $group_final_marks[$student_id][$enrollment_course_id]['final'] ?? null;

            $setData = [
                    "internal_mark" => $internal_mark,
                    "external_mark" => $external_mark,
                    "final_mark" => $final_mark,
                ];
            StudentCourseWiseMark::updateOrCreate(["student_id" => $student_id, "enrollment_course_id" => $enrollment_course_id] , $setData);
            //End Student Mark Course Wise
        }
    }
}
