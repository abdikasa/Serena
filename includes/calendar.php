<?php
echo '<select class="bear-dates" name="select_days" title="Must be at least 16 years old to create an account.">';
dates("option");
echo '</select>';
echo '<select class="bear-months" name="select_months" title="Must be at least 16 years old to create an account.">';
months("option");
echo '</select>';
echo '<select class="bear-years" name="select_years" title="Must be at least 16 years old to create an account." required>';
years("option", 1940, date("Y"));
echo '</select>';

function dates($tags)
{
    if ($tags == '')
    //If the dates('') paramenter is empty, add no tags
    {
        $dates = "";
        $i = 1;
        for ($i = 1; $i < 32; $i++) {
            $dates = $i;
        }
    } else
    //If the dates('option') has paramenter, add the tags to it
    {
    
        for ($i = 1, $dates = ""; $i < 32; $i++) {
            $dates .= "<" . $tags;
            if ($_POST["select_days"] == $i) {
                $dates .= " selected";
            }
            $dates .= ">" . $i . "</" . $tags . ">";
        }
    }
    echo $dates;
}


    
    


// //Months method
function months($tags)
{
    //List all the Days with array
    $list_months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    if ($tags == '')
    //If the months('') paramenter is empty, add no tags
    {
        for ($i = 0, $l = count($list_months), $months = ""; $i < $l; $i++) {
            $months += $list_months[$i];
        }
    } else
    //If the months('option') has paramenter, add the tags to it
    {
        for ($i = 0, $l = count($list_months), $months = ""; $i < $l; $i++) {
            $months .= "<" . $tags;
            if (isset($_POST["select_months"]) && $_POST["select_months"] == $list_months[$i]) {
                $months .= " selected";
            }
            $months .= ">" . $list_months[$i] . "</" . $tags . ">";
        }
    }
    echo $months;
}



// //Short Months method
// function short_months(tags) {
// 	//List all the Months with array
// 	var list_months = [
// 		'Jan',
// 		'Feb',
// 		'Mar',
// 		'Apr',
// 		'May',
// 		'Jun',
// 		'Jul',
// 		'Aug',
// 		'Sep',
// 		'Oct',
// 		'Nov',
// 		'Dec'
// 	];

// 	if (tags == '')
// 	//If the short_months('') paramenter is empty, add no tags
// 	{
// 		var i;
// 		for (i = 0, l = list_months.length, months = ""; i < l; i++) {
// 			months += list_months[i];
// 		}
// 	}
// 	else
// 	//If the months('option') has paramenter, add the tags to it
// 	{
// 		for (i = 0, l = list_months.length, months = ""; i < l; i++) {
// 			months += "<" + tags + ">" + list_months[i] + "</" + tags + ">";
// 		}
// 	}

// 	//You can call the class multiple times						
// 	var multiple_list = document.getElementsByClassName("bear-short-months");
// 	for (i = 0; i < multiple_list.length; i++) {
// 		multiple_list[i].innerHTML = months;
// 	}
// }


//Year method
function years($tags, $startY, $endY)
{
    if ($tags == '')
    //If the years('') paramenter is empty, add no tags
    {
        echo "this ran";
        $years = "";
        for ($i = $endY; $i < $startY + 1; $i--) {
            $years -= $i;
        }
    } else
    //If the years('option') has paramenter, add the tags to it
    {
        $years = "";
        for ($i = $endY; $i > $startY - 1; $i--) {
            $years .= "</br><" . $tags . " ";
            if (isset($_POST["select_years"]) && $_POST["select_years"] == $i) {
                $years .= " selected";
            }
            $years .= ">" . $i .  " </" . $tags . ">";
        }
    }

    echo $years;
}
