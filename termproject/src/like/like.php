<?php

$con = mysqli_connect("localhost", "root", "", "termproject");

$like_id = $_POST['likedId']; // 좋아요가 눌린 게시판 글쓴이의 id 가져오기
$board_num = $_POST['boardNum']; // 게시글 번호 가져오기
/*$get_board_num = $_GET['getBoardNum']; // 게시글 번호 가져오기*/

if(!empty($board_num)) {
    $sql1 = "SELECT * from like_table WHERE board_num = '$board_num' AND liked_id = '$like_id'";
    $res1 = mysqli_num_rows(mysqli_query($con, $sql1)); // sql 의 행 갯수를 가져옴

    if($res1 == 0) {
        // 좋아요 기록이 없는 경우 좋아요 등록
        $sql2 = "INSERT into like_table VALUES(0, '$board_num', '$like_id', 1, sysdate())";
        $res2 = mysqli_query($con, $sql2);

        // 게시판 테이블 업데이트
        $sql3 = "UPDATE board SET like_count = like_count + 1 WHERE num = $board_num";
        $res3 = mysqli_query($con, $sql3);
        echo $res2 && $res3 ? "like" : "failed";
    } else {
        // 좋아요가 눌려 있는 경우 좋아요 취소
        $sql2 = "DELETE from like_table WHERE board_num = '$board_num' AND liked_id = '$like_id'";
        $res2 = mysqli_query($con, $sql2);
        
        // 게시판 테이블 업데이트
        $sql3 = "UPDATE board SET like_count = like_count - 1 WHERE num = $board_num";
        $res3 = mysqli_query($con, $sql3);
        echo $res2 && $res3 ? "unlike" : "failed";
    }
} /*else if(!empty($get_board_num)) {
    $sql1 = "SELECT * from like_table WHERE board_num = '$get_board_num' AND liked_id = '$like_id'";
    $res1 = mysqli_num_rows(mysqli_query($con, $sql1)); // sql 의 행 갯수를 가져옴 
    
    echo $res1 != 0 ? "liked" : "unliked";

}
mysql_close($con);
*/
?>