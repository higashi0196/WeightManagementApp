'use strict';

{

    // todo checkbox toggle機能 非同期通信
    const toggles = document.querySelectorAll('input[type="checkbox"]');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', () => {
            fetch('./toggle.php', {
            method: 'POST',
            body: new URLSearchParams({
            id: toggle.dataset.id,
            token: toggle.closest('tr').dataset.token,
            }),
        }).then(response => {
            return response.json();
        }).then(json => {     
            console.log(json);
        })
        .catch(error => {
            window.location.href = './../../view/error/404.php';
            console.log("削除に失敗しました");
        });
            toggle.closest('tr').children[1].classList.toggle('done');
            toggle.closest('tr').children[2].classList.toggle('done');
        });
    });

    // todo 削除機能 非同期通信
    const deletebtns = document.querySelectorAll('.delete-btn');
    deletebtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (!confirm('削除しますか?')) {
            return;
            }
        fetch('./delete.php', {
            method: 'POST',
            body: new URLSearchParams({
            id: btn.dataset.id,
            token: btn.closest('tr').dataset.token,
        }),
        }).then(response => {
            return response.json();
        }).then(json => {
            console.log(json);
        })
        .catch(error => {
            window.location.href = './../../view/error/404.php';
            console.log("削除に失敗しました");
        })
            btn.closest('tr').remove();
        });
    });

    // post 削除機能 非同期通信
    const word = document.getElementById("word");
    const wordbtn = document.querySelector('.wordbtn');
    wordbtn.addEventListener('click', () => {
        if (!confirm('削除する?')) {
            return;
        }
        fetch('./../post/postdelete.php', {
            method: 'POST',
            body: new URLSearchParams({
            token: wordbtn.dataset.token,
            }),
        }).then(response => {
            return response.json();
        })
        .then(json => {
            word.textContent = '一言メッセージを入力できます';
            console.log(json);
        })
        .catch(error => {
            window.location.href = './../../view/error/404.php';
            console.log("削除に失敗しました");
        })
    });

    const achieve = document.querySelector('.achieve');
    const achieve2 = document.querySelector('.achieve2');

    if (difference <= 0) {
        achieve.style.display = 'block';
        console.log("0kg以下,達成");
    } else if (difference < goalweight * 0.01) {
        achieve.style.display = 'block';
        achieve.classList.add('achieve2');
        achieve.textContent =  'あと ' + difference + ' kg ' + 'もう少し頑張ろう !';
        console.log("もう少し,頑張ろう");
    }  else {
        achieve.style.display = 'none';
        achieve.textContent =  'あと ' + difference + ' kg ';
        console.log("まだまだ");
    }

}