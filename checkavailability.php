<section id="availability">
    <div class="container">
        <div class="shadow-sm p-1 bg-body rounded">
            <form action="" method="POST" onsubmit="">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="inputCheckIn" class="col-form-label">Check-In</label>
                    </div>
                    <div class="col-auto">
                        <input class="form-control" type="date" id="CheckIn" name="date" type="text" />
                    </div>

                    <div class="col-auto">
                        <label for="inputCheckOut" class="col-form-label">Check-Out</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control" type="date" id="CheckOut" name="date" type="text" />
                    </div>

                    <div class="col-auto vertical">
                        <label for="inputAdult" class="col-form-label">Adult</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcount" id="adultcount" value="1" min="1">
                    </div>


                    <div class="col-auto">
                        <label for="inputChild" class="col-form-label">Child</label>
                    </div>

                    <div class="col-auto">
                        <input class="form-control-num" type="number" name="guestcount" id="childadult" value="0" min="0">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"> Check Availability </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>