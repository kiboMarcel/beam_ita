<?php

namespace App\Http\Controllers\backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\student_final_mark;

class FinalMArkController extends Controller
{
    //

    /* GET RANK  */
   /*  SELECT x.id, x.position, x.final_marks 
FROM (SELECT t.id, t.final_marks, @rownum := @rownum + 1 AS position
      FROM student_final_marks as t 
      JOIN (SELECT @rownum := 0) r
      ORDER BY t.final_marks DESC) x */
      /* GET RANK  */
}
