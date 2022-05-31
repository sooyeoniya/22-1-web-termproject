
$(".btn-like").on("click", function(e) {
    var button = $(e.currentTarget || e.target)
    var likeCount = button.find(".like-count")
    var heartShape = button.find(".heart-shape")
    $.post("./like.php", {
        likedId: button.data("liked-id"),
        boardNum: button.data("board-num")
    }, function(res) {
        /*테스트*/
        let likedId = button.data("liked-id")
        console.log(likedId)
        let boardNum = button.data("board-num")
        console.log(boardNum)
        var addCount = (res == "like" ? 1 : res == "unlike" ? -1 : 0)
        likeCount.text(+likeCount.text() + addCount)
        heartShape.text(res == "like" ? "❤" : res == "unlike" ? "🤍" : "🤍")
    })
})


/*$(".btn-like").each(function(idx, el) {
    var button = $(el)
    var heartShape = button.find(".heart-shape")
    $.get("./like.php", {
        getBoardNum: button.data("board-num")
    }, function(res) {
        heartShape.text(res == "liked" ? "♥" : "🤍")
        button.fadeIn(500)
    })
    
})
*/