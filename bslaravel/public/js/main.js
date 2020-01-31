

function fire(col, row) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: '/play',
        cache: false,
        dataType: 'json',
        data: {
            _token: CSRF_TOKEN,
            row: row,
            col: col,
        },
        success: function (data) {
            if(data.hit == true) {
                $('#npc'+col+row).removeClass("btn-info").addClass("btn-danger").addClass('disabled').attr('disabled', true);
            } else {
                $('#npc'+col+row).removeClass("btn-info").addClass("btn-success").addClass('disabled').attr('disabled', true);
            }
            $('#msg').text(data.message);

            if(data.npcHits == true){
                $('#user'+data.col+data.row).removeClass("btn-info").addClass("btn-danger").addClass('disabled').attr('disabled', true);
            } else {
                $('#user'+data.col+data.row).removeClass("btn-info").addClass("btn-success").addClass('disabled').attr('disabled', true);
            }

        }
    });
}

function colorUserField(field) {
    for (col = 'A'; col <= 'J'; col++){
        for (row = 1; row <= 10; row++){
            if(field[col][row] === ' ') {
                $('#user'+col+row).removeClass("btn-info").addClass("btn-danger").addClass('disabled').attr('disabled', true);
            } else if (field[col][row] === 'X') {
                $('#user'+col+row).removeClass("btn-info").addClass("btn-success").addClass('disabled').attr('disabled', true);
            }
        }
    }
}

function colorNPCField(field) {
    for (col = 'A'; col <= 'J'; col++){
        for (row = 1; row <= 10; row++){
            if(field[col][row] === ' ') {
                $('#npc'+col+row).removeClass("btn-info").addClass("btn-danger").addClass('disabled').attr('disabled', true);
            } else if (field[col][row] === 'X') {
                $('#npc'+col+row).removeClass("btn-info").addClass("btn-success").addClass('disabled').attr('disabled', true);
            }
        }
    }
}
