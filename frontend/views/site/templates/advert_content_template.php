<div class="container" style="width:550px;max-width: 550px; max-height:550px;">
    <div class="row map_advert_baloon">
        <div class="col-lg-4">
            <div class="tutor_card">
                <img src="img/150x150.gif">
                <br/>
                {{ properties.tplVars.tutorName }}
            </div>
        </div>
        <div class="col-lg-8">

            <div class="row">
                <div class="col-sm-4">
                    <label>Адрес</label>
                </div>
                <div class="col-sm-8">
                    <value>{{ properties.tplVars.city }}, {{ properties.tplVars.address }}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Цена и место</label>
                </div>
                <div class="col-sm-8">
                    <table class="adver_prices_table">
                        <tr>
                            <td>У&nbsp;ученика</td>
                            <td>У&nbsp;преподавателя</td>
                            <td>Дистанционно</td>
                        </tr>
                        <tr>
                            <td>{{ properties.tplVars.studentPlacePrice }}</td>
                            <td>{{ properties.tplVars.tutorPlacePrice }}</td>
                            <td>{{ properties.tplVars.remotePlacePrice }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Предметы</label>
                </div>
                <div class="col-sm-8">
                    <value>{{ properties.tplVars.subjects }}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Цели</label>
                </div>
                <div class="col-sm-8">
                    <value>{{ properties.tplVars.goals }}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Статус репетитора</label>
                </div>
                <div class="col-sm-8">
                    <value>{{ properties.tplVars.grade }}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Стаж преподавания</label>
                </div>
                <div class="col-sm-8">
                    <value>{{ properties.tplVars.experience|default: Без опыта }}</value>
                </div>
            </div>

        </div>
    </div>
</div>