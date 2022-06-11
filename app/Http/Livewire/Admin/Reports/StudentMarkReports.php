<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Http\Livewire\AdminComponent as AdminComponent;
use App\Models\Enrollment;
// use App\Models\EnrollmentComponentType;
use App\Models\StudentMark;
// use App\Models\EnrollmentStudent;
// use App\Models\StudentMarkDetail;
// use App\Models\EnrollmentCourse;
// use App\Models\EnrollmentComponentGroup;
use Arr;
class StudentMarkReports extends AdminComponent
{
    
    public $page_title = "Student Mark Report";
    public $students, $enrollment_id, $header;

    public $sortField = "id", $sortDirection = "DESC", $sortFieldData = [];

    public function render()
    {
        //  dd( $this->fdata );
        return view('livewire.admin.reports.student-mark.student-mark-list');
    }

    public function mount()
    {
        $this->model = new StudentMark;
        $this->setStudents();

    }

  
    public function setStudents()
    {
       // Start Set Default variable
        
        $header= [];
        $color_class_arr[] = " table-success ";
        $color_class_arr[] = " table-danger ";
        $color_class_arr[] = " table-info ";
        $color_class_arr[] = " table-primary ";
        $color_class_arr[] = " table-secondary ";
        $color_class_arr[] = " table-warning ";
        $color_class_arr[] = " table-light ";
        $color_class_arr[] = " table-dark ";

        $header['heading_enrollment'] = [];
        $header['heading_course'] = [];
        $header['heading_group'] = [];
        $header['heading_type'] = [];

        $header['heading_course'][] = [
            "display" => "Student Name",
            "colspan" => 1,
            "width"  => " 40% ",
            "style_class" => "bg-secondary"
        ];
        $header['heading_group'][] = [
            "display" => "Component Group",
            "colspan" => 1,
            "style_class" => "bg-secondary"
        ];
        $header['heading_type'][] = [
            "display" => "Component Type",
            "colspan" => 1,
            "style_class" => "bg-secondary"
        ];
        $style_class = "";
        // End Set Default variable


        $enrollments = Enrollment::with([])->where(['id' => $this->enrollment_id])->get();
     

        //Start Enrollment Loop
        foreach ($enrollments as $enrollment) {
            $basic_details_columns = 1;
            $result_group_columns = 4; 
            $converted_mark_type_columns = 1; 
            $colspan_enrollment = 0;
            $colspan_course = 0;
            $colspan_group = 0;
            
            $enrollment_id= $enrollment->id;

            $this->fdata['enrollment'][$enrollment_id]['title'] = $enrollment->title; 


            //Start Course Loop
            $enrollment_courses = $enrollment->enrollment_courses;
        
            $course_count = 0 ;
            $group_count = 0 ;
            foreach ( $enrollment_courses as $enrollment_course) {

                $this->setMarks($enrollment_course);
                $this->setFinalMarks($enrollment_course);
                $style_class = $color_class_arr[$course_count++];
                $colspan_course = 0;

                $enrollment_course_id= $enrollment_course->id;

                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['title'] = $enrollment_course->course->title;


                //Start Group Loop
                $enrollment_component_groups = $enrollment_course->enrollment_component_groups->sortBy('academic_component_group.sequence_number');
                foreach ( $enrollment_component_groups as  $enrollment_component_group) {
                    $this->setConvertedMark($enrollment_component_group);

                    $group_count++;
                    $colspan_group = 0;

                    $enrollment_component_group_id = $enrollment_component_group->id;
                    $academic_component_category_title = $enrollment_component_group->academic_component_group->academic_component_category->title;
                    $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['title'] = $enrollment_component_group->academic_component_group->title; 


                    //Start Type Loop
                    $enrollment_component_types = $enrollment_component_group->enrollment_component_types->sortBy('academic_component_type.sequence_number'); 
            
                    foreach ( $enrollment_component_types as $enrollment_component_type) {
                        $colspan_enrollment++;
                        $colspan_course++;
                        $colspan_group++;

                        $enrollment_component_type_id = $enrollment_component_type->id;
                        

                        $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['title'] = $enrollment_component_type->academic_component_type->title;  
                    
                        $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['id'] = $enrollment_component_type_id;  

                        $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['key'] = "mark";  

                        $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['style_class'] = $style_class;  

                        $header['heading_type'][] =[
                            "display" => 
                            "{$enrollment_component_type->academic_component_type->title}
                            <br> <smalll class='font-italic font-weight-normal'> (Max : {$enrollment_component_type->maximum_mark}) </smalll class='font-italic font-weight-normal'>
                          "
                          ,
                            "colspan" => 1,
                            "style_class" => $style_class,
                        ];

                    }
                    $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}cm"]['title'] = "CM";
                    
                    $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}cm"]['key'] = "cm";

                    $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}cm"]['id'] = $enrollment_component_group_id;

                    //End Type Loop
                   
                    $header['heading_type'][] =[
                        "display" =>"CM",
                        "colspan" => $converted_mark_type_columns,
                        "style_class" => $style_class,
                    ];


                    $header['heading_group'][] =[
                        "display" => 
                        "{$enrollment_component_group->academic_component_group->title}
                          <smalll class='font-italic font-weight-normal'> ({$enrollment_component_group->contribution_percentage}%) {$academic_component_category_title}</smalll class='font-italic font-weight-normal'>
                        ",
                        "colspan" =>  $colspan_group + $converted_mark_type_columns,
                        "style_class" => $style_class,
                    ];
                    
                } 

                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}im"]['title'] = "IM";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}im"]['key'] = "im";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}im"]['id'] = $enrollment_course_id;

                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}em"]['title'] = "EM";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}em"]['key'] = "em";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}em"]['id'] = $enrollment_course_id;

                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fm"]['title'] = "FM";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fm"]['key'] = "fm";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fm"]['id'] = $enrollment_course_id;
                
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fg"]['title'] = "FG";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fg"]['key'] = "fg";
                $this->fdata['enrollment'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type']["{$enrollment_component_group_id}fg"]['id'] = $enrollment_course_id;


                //End Group Loop
             
                $header['heading_type'][] =[
                    "display" => "IM",
                    "colspan" => 1,
                    "style_class" => $style_class,
                ];

                $header['heading_type'][] =[
                    "display" => "EM",
                    "colspan" => 1,
                    "style_class" => $style_class,
                ];

                $header['heading_type'][] =[
                    "display" => "FM",
                    "colspan" => 1,
                    "style_class" => $style_class,
                ];

                $header['heading_type'][] =[
                    "display" => "FG",
                    "colspan" => 1,
                    "style_class" => $style_class,
                ];


                $header['heading_group'][] =[
                    "display" =>"Result",
                    "colspan" =>  $result_group_columns,
                    "style_class" => $style_class,
                ];

                $header['heading_course'][] =[
                    "display" => "
                            <smalll class='font-italic font-weight-normal'>{$enrollment_course->course->code}</smalll class='font-italic font-weight-normal'>
                            - {$enrollment_course->course->title}
                            ",
                    "colspan" =>  $colspan_course  + $result_group_columns +  ( $course_count * $converted_mark_type_columns ) +  $result_group_columns,
                    "style_class" => $style_class,
                ];


            }

            //End Course Loop

            $header['heading_enrollment'][] =[
                "display" => $enrollment->title,
                "colspan" => $colspan_enrollment + $basic_details_columns + ($result_group_columns * $course_count) + ($group_count * $converted_mark_type_columns) ,
                "style_class" => $style_class,
            ];
            


            //Start Student Loop
            $students = $enrollment->enrollment_students->sortBy("student.id");
            $enrollment_type_finals = Arr::collapse(data_get($this->fdata, "enrollment.*.course.*.group.*.type" ));
            foreach ($students as $student) {

                $display = [];
                $student_id = $student['student_id'];

                $display[] = [ 
                                "display"  => $student['student']['title'],
                            ];
                foreach ($enrollment_type_finals as $enrollment_component_type) {
                    $mark_key = $enrollment_component_type['key'] ?? null;

                    switch ($mark_key) {
                        case "cm" : 
                            //Start CM
                            $style_class = "bg-info";
                            $mark_key = $enrollment_component_type['key'] ?? null;
                            $enrollment_component_group_id = $enrollment_component_type['id'] ?? null;

                            $converted_mark = $this->fdata['converted_marks'][$student_id][$enrollment_component_group_id]['converted_mark'] ?? null;
                            if(!empty($converted_mark)) {
                                $display_mark =  $converted_mark;
                            } else {
                                $display_mark = __("msg.na");
                                $style_class = "bg-danger";
                            }
                            $display[] = [ 
                                "display"  => $display_mark,
                                "style_class" => $style_class,
                            ];
                            break;
                            //End CM
                        case "im" :
                            //Start IM 
                            $style_class = "bg-success";
                            $mark_key = $enrollment_component_type['key'] ?? null;
                            $enrollment_course_id = $enrollment_component_type['id'] ?? null;

                            $internal_mark = $this->fdata['final_marks'][$student_id][$enrollment_course_id]['internal_mark'] ?? null;
                            if(!empty($internal_mark)) {
                                $display_mark =  $internal_mark;
                            } else {
                                $display_mark = __("msg.na");
                                $style_class = "bg-danger";
                            }
                            $display[] = [ 
                                "display"  => $display_mark,
                                "style_class" => $style_class,
                            ];
                            break;
                            //End IM
                        case "em" : 
                            //Start EM
                            $style_class = "bg-success";
                            $mark_key = $enrollment_component_type['key'] ?? null;
                            $enrollment_course_id = $enrollment_component_type['id'] ?? null;

                            $external_mark = $this->fdata['final_marks'][$student_id][$enrollment_course_id]['external_mark'] ?? null;
                            if(!empty($external_mark)) {
                                $display_mark =  $external_mark;
                            } else {
                                $display_mark = __("msg.na");
                                $style_class = "bg-danger";
                            }
                            $display[] = [ 
                                "display"  => $display_mark,
                                "style_class" => $style_class,
                            ];
                            break;
                            //End EN
                        case "fm" : 
                            //Start FM
                            $style_class = "bg-success";
                            $mark_key = $enrollment_component_type['key'] ?? null;
                            $enrollment_course_id = $enrollment_component_type['id'] ?? null;

                            $final_mark = $this->fdata['final_marks'][$student_id][$enrollment_course_id]['final_mark'] ?? null;
                            if(!empty($final_mark)) {
                                $display_mark =  $final_mark;
                            } else {
                                $display_mark = __("msg.na");
                                $style_class = "bg-danger";
                            }
                            $display[] = [ 
                                "display"  => $display_mark,
                                "style_class" => $style_class,
                            ];
                            break;
                            //End FM
                        case "fg" :
                            //Start FG
                            $style_class = "bg-success";
                            $display[] = [ 
                                "display"  => " ",
                                "style_class" => $style_class,
                            ];
                            break;
                            //End FG
                        case "mark" :                              
                            //Start Mark
                            $enrollment_component_type_id = $enrollment_component_type['id'] ?? null;

                            $style_class = $enrollment_component_type['style_class'] ?? null;
        
                            if(!empty($this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['mark']) || !empty($this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['is_absent'])) {
        
                                $mark = $this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['mark'] ?? null;
        
                                $is_absent = $this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['is_absent'] ?? null;
                            
                            
                                if($is_absent) {
                                    $display_mark = "A"; 
                                    $style_class = "bg-danger";
                                } else {
                                    $display_mark = $mark; 
                                }
                                $display[] = [ 
                                                "display"  => $display_mark,
                                                "style_class" => $style_class,
                                            ];
                            } else {
                                $style_class = "bg-warning";
        
                                $display[] = [ 
                                    "display"  => " ",
                                    "style_class" => $style_class,
                                ];
                            }
                        break;
                        //End Mark 
                    }
                   
                }          
            
                $this->students[$student_id] = $display;

            }
            //End Student Loop
        }
        //End Enrollment Loop

        $this->header =  $header;
    }
    
    public function setConvertedMark($enrollment_group)
    {
        $student_group_wise_marks = $enrollment_group->student_group_wise_marks;
        foreach ($student_group_wise_marks as $student_group_wise_mark) {
            $enrollment_component_group_id = $student_group_wise_mark["enrollment_component_group_id"];
            $converted_mark = $student_group_wise_mark["converted_mark"];
            $student_id = $student_group_wise_mark["student_id"];

            $this->fdata['converted_marks'][$student_id][$enrollment_component_group_id]['converted_mark'] = $converted_mark; 
        }
    }
    public function setMarks($enrollment_course)
    {
        foreach ( $enrollment_course->student_mark as $student_mark) {

            $student_mark_details = $student_mark->student_mark_details;
            
            foreach ( $student_mark_details as $student_mark_detail ) {

                // $enrollment_id = $student_mark_detail->student_mark->enrollment_component_type->enrollment_component_group->enrollment_course->enrollment->id;

                // $enrollment_course_id = $student_mark_detail->student_mark->enrollment_component_type->enrollment_component_group->enrollment_course->id;

                // $enrollment_component_group_id = $student_mark_detail->student_mark->enrollment_component_type->enrollment_component_group->id;

                $enrollment_component_type_id = $student_mark_detail->student_mark->enrollment_component_type->id;

                // $student_mark_id = $student_mark_detail->student_mark->id;
                
                // $student_mark_detail_id = $student_mark_detail->id;

                $student_id = $student_mark_detail->student->id;

                //    $this->fdata['enrollment_marks'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['student'][$student_id]['mark']= $student_mark_detail->mark;
                
                
                //    $this->fdata['enrollment_marks'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['student'][$student_id]['is_absent']= $student_mark_detail->is_absent;

                //    $this->fdata['enrollment_marks'][$enrollment_id]['course'][$enrollment_course_id]['group'][$enrollment_component_group_id]['type'][$enrollment_component_type_id]['student'][$student_id]['individual_exam_date']= $student_mark_detail->individual_exam_date;

                //=====================================

                $this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['mark'] = $student_mark_detail->mark;
                
                $this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['is_absent'] = $student_mark_detail->is_absent;

                $this->fdata['enrollment_marks'][$student_id]['type'][$enrollment_component_type_id]['individual_exam_date'] = $student_mark_detail->individual_exam_date;

                }
            }   
        }
    

    public function setFinalMarks($enrollment_course)
    {
        foreach ( $enrollment_course->student_course_wise_marks as $student_course_wise_mark) {
            $student_id = $student_course_wise_mark->student_id;
            $enrollment_course_id = $student_course_wise_mark->enrollment_course_id;
            $internal_mark = $student_course_wise_mark->internal_mark;
            $external_mark = $student_course_wise_mark->external_mark;
            $final_mark = $student_course_wise_mark->final_mark;

            $this->fdata['final_marks'][$student_id][$enrollment_course_id]['internal_mark'] = $internal_mark;
            $this->fdata['final_marks'][$student_id][$enrollment_course_id]['external_mark'] = $external_mark;
            $this->fdata['final_marks'][$student_id][$enrollment_course_id]['final_mark'] = $final_mark;
        }
    }
}
