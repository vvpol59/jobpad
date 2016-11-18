/**
 * Сервисы доски задач
 * Created by vvpol on 27.09.2016.
 */
(function(){
    window.angularApp.factory('dataServices', function(){
        return  {
            projects: [
                {name: 'Первая строка', begin: '1.1.16', status: 'closed'},
                {name: 'Вторая строка', begin: '1.1.16', status: 'closed'},
                {name: 'Третья строка', begin: '1.1.16', status: 'closed'},
                {name: 'Червёртая строка', begin: '1.1.16', status: 'closed'}
            ],
            jobs: [
                {name: 'Задача 1', status: 'current'},
                {name: 'Задача 2', status: 'current'}
        ],
            startMenu: [
                {name: 'Сотрудники', code: 'employee-list'},
                {name: 'Проекты', code: 'proj-list'}
            ],
            labels: [
                {name: 'label 1', pos: 1},
                {name: 'label 11', pos: 100},
                {name: 'label 2', pos: 3}
            ],
            employees: [
                {name: "test 1", email: "email 1"},
                {name: "test 2", email: "email 2"},
                {name: "test 3", email: "email 3"}
            ]
        }

    });
})();