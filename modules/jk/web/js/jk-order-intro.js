function startIntro() {
    var intro = introJs();
    intro.setOption('showProgress', true);
    intro.setOption('nextLabel', 'Вперёд');
    intro.setOption('prevLabel', 'Назад');
    intro.setOption('skipLabel', 'Пропустить');
    intro.setOption('doneLabel', 'Закончить');
    intro.setOptions({
        showProgress: true,
        nextLabel: 'Вперёд',
        prevLabel: 'Назад',
        skipLabel: 'Пропустить',
        doneLabel: 'Закончить',
        steps: [
            {
                intro: "Здраствуйте, я ваш визуальный помощник по заполнению формы заявки на оказание материальной" +
                    "помощи для улучшения жилищных условий"
            },
            {
                element: '#tab-params',
                intro: "Вам нужно заполнить общие параметры по вашей заявке"
            },
            {
                element: '#tab-user',
                intro: "Аналогичным образом вам нужно будет заполнить данные в каждой из вкладок формы"
            },

            {
                element: '#tab-spouse',
                intro: "Если у вас есть супруг или супруга, то обязательно нужно указать данные по ним"
            },
            {
                element: '#btn-child-grid-view-update',
                intro: 'После проверки и изменения данных по вашим детям, не забудьте нажать кнопку ОБНОВИТЬ',
            },
            {
                element: '#btn-save',
                intro: "После того, как вы укажите все данные по вашей заявке, обязательно нажмите кнопку СОХРАНИТЬ",
                //position: 'right'
            },
            {
                element: '#btn-message',
                intro: "Если в процессе заполнения заявки у вас возникли какие вопросы, вы всегда можете связаться " +
                    "с ответственным куратором в вашем филиале",
            },
            {
                intro: "На этом я завершаю свою работу, если у вас остались какие-то вопросы, то вы можете" +
                    " повторно запустить меня",
                //position: 'right'
            },
        ]
    });

    // TODO: Тут нужно подумать, т.к. не получается одновременно активировать элемент и TAB
    intro.onchange(function (targetElement) {
        switch (targetElement.id) {
            case "tab-spouse":
                $('#tab-child').tab('show')
                break;
        }
    }).start();
}