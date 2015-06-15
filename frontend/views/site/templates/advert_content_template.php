<div class="row advert_search_result">
    <div class="col-lg-4">
        <div class="tutor_card">
            <img src="img/150x150.gif">
            <br />
            {{ properties.tplVars.tutorName }}
        </div>
    </div>
    <div class="col-lg-8">
        <div class="advert_details">
            <div class="advert_details_entry">
                <label>Адрес</label>
                <value>{{ properties.tplVars.city }}, {{ properties.tplVars.address }}</value>
            </div>

            <div class="advert_details_entry">
                <label>Цена и место</label>
                <table class="adver_prices_table">
                    <tr>
                        <td>У ученика</td>
                        <td>У преподавателя</td>
                        <td>Дистанционно</td>
                    </tr>
                    <tr>
                        <td>{{ properties.tplVars.studentPlacePrice }}</td>
                        <td>{{ properties.tplVars.tutorPlacePrice }}</td>
                        <td>{{ properties.tplVars.remotePlacePrice }}</td>
                    </tr>
                </table>
            </div>

            <div class="advert_details_entry">
                <label>Предметы</label>
                <value>{{ properties.tplVars.subjects }}</value>
            </div>

            <div class="advert_details_entry">
                <label>Цели</label>
                <value>{{ properties.tplVars.goals }}</value>
            </div>

            <div class="advert_details_entry">
                <label>Статус репетитора</label>
                <value>{{ properties.tplVars.grade }}</value>
            </div>

            <div class="advert_details_entry">
                <label>Стаж преподавания</label>
                <value>{{ properties.tplVars.experience|default: Без опыта }}</value>
            </div>

        </div>
    </div>
</div>