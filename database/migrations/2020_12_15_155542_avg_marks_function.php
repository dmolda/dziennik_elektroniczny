<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvgMarksFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $import = ( '
        delimiter //
CREATE FUNCTION `AvgMarksFunction`(`id` INT(50), `subjects_id` INT(50)) RETURNS DECIMAL(30,2) BEGIN
DECLARE suma1 INT;
DECLARE suma2 INT;
DECLARE suma3 INT;
DECLARE suma4 INT;
DECLARE suma5 INT;
DECLARE suma6 INT;
DECLARE ilosc1 INT;
DECLARE ilosc2 INT;
DECLARE ilosc3 INT;
DECLARE ilosc4 INT;
DECLARE ilosc5 INT;
DECLARE ilosc6 INT;
DECLARE wynik FLOAT;


SET suma1 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 1 LIMIT 1);
IF suma1 IS NULL THEN
set suma1 = 0;
END IF;

SET suma2 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 2 LIMIT 1);
IF suma2 IS NULL THEN
set suma2 = 0;
END IF;

SET suma3 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 3 LIMIT 1);
IF suma3 IS NULL THEN
set suma3 = 0;
END IF;

SET suma4 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 4 LIMIT 1);
IF suma4 IS NULL THEN
set suma4 = 0;
END IF;

SET suma5 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 5 LIMIT 1);
IF suma5 IS NULL THEN
set suma5 = 0;
END IF;

SET suma6 =(SELECT SUM(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 6 LIMIT 1);
IF suma6 IS NULL THEN
set suma6 = 0;
END IF;

SET ilosc1 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 1 LIMIT 1);
IF ilosc1 IS NULL THEN
set ilosc1 = 0;
ENd IF;

SET ilosc2 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 2 LIMIT 1);
IF ilosc2 IS NULL THEN
set ilosc2 = 0;
ENd IF;

SET ilosc3 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 3 LIMIT 1);
IF ilosc3 IS NULL THEN
set ilosc3 = 0;
END IF;

SET ilosc4 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 4 LIMIT 1);
IF ilosc4 IS NULL THEN
set ilosc4 = 0;
END IF;

SET ilosc5 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 5 LIMIT 1);
IF ilosc5 IS NULL THEN
set ilosc5 = 0;
ENd IF;

SET ilosc6 =(SELECT COUNT(mark)*weight FROM `marks` WHERE subjects_id = @p1 AND students_id = @p0 AND weight = 6 LIMIT 1);
IF ilosc6 IS NULL THEN
set ilosc6 = 0;
END IF;

SET wynik = (suma1+suma2+suma3+suma4+suma5+suma6)/(ilosc1+ilosc2+ilosc3+ilosc4+ilosc5+ilosc6);

	RETURN wynik;
END//
delimiter ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        ('DROP FUNCTION AvgMarksFunction');
    }
}
