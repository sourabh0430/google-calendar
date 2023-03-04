<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>DevExtreme Demo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.2.3/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/22.2.3/js/dx.all.js"></script>
    
    <script>
const employees = [{
  text: 'John Heart',
  id: 1,
  color: '#56ca85',
  avatar: '',
  age: 27,
  discipline: 'ABS, Fitball, StepFit',
}];
const data = [
  {
    text: 'Helen',
    employeeID: 1,
    startDate: new Date('2021-06-01T16:30:00.000Z'),
    endDate: new Date('2021-06-01T18:30:00.000Z'),
  }, {
    text: 'Helen',
    employeeID: 1,
    startDate: new Date('2021-06-10T16:30:00.000Z'),
    endDate: new Date('2021-06-11T18:30:00.000Z'),
  }, {
    text: 'Alex',
    employeeID: 1,
    startDate: new Date('2021-06-02T16:30:00.000Z'),
    endDate: new Date('2021-06-02T18:30:00.000Z'),
  }, {
    text: 'Alex',
    employeeID: 1,
    startDate: new Date('2021-06-11T19:00:00.000Z'),
    endDate: new Date('2021-06-11T20:00:00.000Z'),
  }, {
    text: 'Alex',
    employeeID: 1,
    startDate: new Date('2021-06-16T16:30:00.000Z'),
    endDate: new Date('2021-06-16T18:30:00.000Z'),
  }, {
    text: 'Stan',
    employeeID: 1,
    startDate: new Date('2021-06-07T16:30:00.000Z'),
    endDate: new Date('2021-06-07T18:30:00.000Z'),
  }, {
    text: 'Stan',
    employeeID: 1,
    startDate: new Date('2021-06-28T16:30:00.000Z'),
    endDate: new Date('2021-06-28T18:30:00.000Z'),
  }, {
    text: 'Stan',
    employeeID: 1,
    startDate: new Date('2021-06-30T16:30:00.000Z'),
    endDate: new Date('2021-06-30T18:30:00.000Z'),
  }, {
    text: 'Rachel',
    employeeID: 1,
    startDate: new Date('2021-06-04T16:30:00.000Z'),
    endDate: new Date('2021-06-04T18:30:00.000Z'),
  }, {
    text: 'Rachel',
    employeeID: 1,
    startDate: new Date('2021-06-07T16:30:00.000Z'),
    endDate: new Date('2021-06-07T18:30:00.000Z'),
  }, {
    text: 'Rachel',
    employeeID: 1,
    startDate: new Date('2021-06-21T16:30:00.000Z'),
    endDate: new Date('2021-06-21T18:30:00.000Z'),
  }, {
    text: 'Kelly',
    employeeID: 1,
    startDate: new Date('2021-06-15T16:30:00.000Z'),
    endDate: new Date('2021-06-15T18:30:00.000Z'),
  }, {
    text: 'Kelly',
    employeeID: 1,
    startDate: new Date('2021-06-29T16:30:00.000Z'),
    endDate: new Date('2021-06-29T18:30:00.000Z'),
  },
];

$(() => {
  $('.scheduler').dxScheduler({
    timeZone: 'America/Los_Angeles',
    dataSource: data,
    views: ['month'],
    currentView: 'month',
    currentDate: new Date(2021, 5, 2, 11, 30),
    firstDayOfWeek: 1,
    startDayHour: 8,
    endDayHour: 18,
    showAllDayPanel: false,
    height: 600,
    groups: ['employeeID'],
    resources: [
      {
        fieldExpr: 'employeeID',
        allowMultiple: false,
        dataSource: employees,
        label: 'Employee',
      },
    ],
    dataCellTemplate(cellData, index, container) {
      const { employeeID } = cellData.groups;
      const currentTraining = getCurrentTraining(cellData.startDate.getDate(), employeeID);

      const wrapper = $('<div>')
        .toggleClass(`employee-weekend-${employeeID}`, isWeekEnd(cellData.startDate)).appendTo(container)
        .addClass(`employee-${employeeID}`)
        .addClass('dx-template-wrapper');

      wrapper.append($('<div>')
        .text(cellData.text)
        .addClass(currentTraining)
        .addClass('day-cell'));
    },
    resourceCellTemplate(cellData) {
      const name = $('<div>')
        .addClass('name')
        .css({ backgroundColor: cellData.color })
        .append($('<h2>')
          .text(cellData.text));

      const avatar = $('<div>')
        .addClass('avatar')
        .html(`<img src=${cellData.data.avatar}>`)
        .attr('title', cellData.text);

      const info = $('<div>')
        .addClass('info')
        .css({ color: cellData.color })
        .html(`Age: ${cellData.data.age}<br/><b>${cellData.data.discipline}</b>`);

      return $('<div>').append([name, avatar, info]);
    },
  });

  function isWeekEnd(date) {
    const day = date.getDay();
    return day === 0 || day === 6;
  }

  function getCurrentTraining(date, employeeID) {
    const result = (date + employeeID) % 3;
    const currentTraining = `training-background-${result}`;
    return currentTraining;
  }
});



    </script>
  </head>
  <body class="dx-viewport">
    <div class="demo-container">
      <div class="scheduler"></div>
    </div>
  </body>
</html>