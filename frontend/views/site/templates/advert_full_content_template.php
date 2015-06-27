<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{:tutorName }}</h4>
</div>
<div class="modal-body">

<div class="">
    <div class="row map_advert_baloon">
        <div class="col-lg-4">
            <div class="tutor_card">
                <img src="{{:avatar }}">
                <br/>
                {{:tutorName }}
                <br/>
                {{html:tutorPhonesLines }}
            </div>
        </div>
        <div class="col-lg-8">

            <div class="row">
                <div class="col-sm-4">
                    <label>Адрес</label>
                </div>
                <div class="col-sm-8">
                    <value>{{:city }}, {{:address }}</value>
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
                            <td>{{:studentPlacePrice }}</td>
                            <td>{{:tutorPlacePrice }}</td>
                            <td>{{:remotePlacePrice }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Предметы</label>
                </div>
                <div class="col-sm-8">
                    <value>{{:subjects}}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Цели</label>
                </div>
                <div class="col-sm-8">
                    <value>{{:goals }}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Статус репетитора</label>
                </div>
                <div class="col-sm-8">
                    <value>{{:grade}}</value>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label>Стаж преподавания</label>
                </div>
                <div class="col-sm-8">
                    <value>{{:experience}}</value>
                </div>
            </div>

        </div>
    </div>
<hr />
    <div class="row">
        <div class="col-sm-12">
            <value>{{:description}}</value>
        </div>
    </div>
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>