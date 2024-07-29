<div class="box">
    <div class="box-body">
					<div class="form-group">
                        <label><?= trans("members_hotel"); ?></label>
                        <select name="id_hotel" class="form-control">
                            <?php if (!empty($_htl)):
                                foreach ($_htl as $_ht): ?>
                                    <option value="<?= $_ht->id_hotel; ?>"><?= esc($_ht->nama); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_email"); ?></label>
                        <input type="email" name="email" class="form-control auth-form-input" placeholder="<?= trans("member_email"); ?>" value="<?= old("email"); ?>" required>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_passw"); ?></label>
                        <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= trans("member_passw"); ?>" value="<?= old("password"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("members_idguest"); ?></label>
                        <input type="text" name="id_guest" class="form-control auth-form-input" placeholder="<?= trans("members_idguest"); ?>" value="<?= old("id_guest"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_phone"); ?></label>
                        <input type="text" name="telepon" class="form-control auth-form-input" placeholder="<?= trans("member_phone"); ?>" value="<?= old("telepon"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_hape"); ?></label>
                        <input type="text" name="handphone" class="form-control auth-form-input" placeholder="<?= trans("username"); ?>" value="<?= old("handphone"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_institution"); ?></label>
                        <input type="text" name="perusahaan" class="form-control auth-form-input" placeholder="<?= trans("member_institution"); ?>" value="<?= old("perusahaan"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_pob"); ?></label>
                        <input type="text" name="tempat_lahir" class="form-control auth-form-input" placeholder="<?= trans("member_pob"); ?>" value="<?= old("tempat_lahir"); ?>" required>
                    </div>
					<div class="form-group">
						<label><?= trans("member_dob"); ?></label>
						<input type='date' id="tanggal_lahir" class="form-control form-input input-account" name="dob" placeholder="<?= trans("member_dob"); ?>" value="<?= old("tanggal_lahir"); ?>" required autocomplete="off">
					</div>
					<div class="form-group">
						<label><?= trans("member_joindate"); ?></label>
						<input type='date' id="join_date" class="form-control form-input input-account" name="dob" placeholder="<?= trans("member_joindate"); ?>" value="<?= old("join_date"); ?>" required autocomplete="off">
					</div>
					<div class="form-group">
                        <label><?= trans("member_type"); ?></label>
                        <select name="id_tipe_member" class="form-control">
                            <?php if (!empty($_mmbrtp)):
                                foreach ($_mmbrtp as $_mmbrt): ?>
                                    <option value="<?= $_mmbrt->id_tipe_member; ?>"><?= esc($_mmbrt->nama); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_print"); ?></label>
                        <select name="is_print_card" class="form-control">
                            <?php if (!empty($_pilih)):
                                foreach ($_pilih as $_pili): ?>
                                    <option value="<?= $_pili->id; ?>"><?= esc($_pili->name); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_initial_point"); ?></label>
                        <input type="text" name="initial_point" class="form-control auth-form-input" placeholder="<?= trans("member_initial_point"); ?>" value="<?= old("initial_point"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_nos"); ?></label>
                        <input type="text" name="initial_number_of_stays" class="form-control auth-form-input" placeholder="<?= trans("member_nos"); ?>" value="<?= old("initial_number_of_stays"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_idtype"); ?></label>
                        <select name="jenis_identitas" class="form-control">
                            <?php if (!empty($_idn)):
                                foreach ($_idn as $_id): ?>
                                    <option value="<?= $_id->id; ?>"><?= esc($_id->nama); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_idnumber"); ?></label>
                        <input type="text" name="no_identitas" class="form-control auth-form-input" placeholder="<?= trans("member_idnumber"); ?>" value="<?= old("no_identitas"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_title"); ?></label>
                        <select name="title" class="form-control">
                            <?php if (!empty($_ttl)):
                                foreach ($_ttl as $_tt): ?>
                                    <option value="<?= $_tt->id; ?>"><?= esc($_tt->name); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_firstname"); ?></label>
                        <input type="text" name="first_name" class="form-control auth-form-input" placeholder="<?= trans("member_firstname"); ?>" value="<?= old("first_name"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_lastname"); ?></label>
                        <input type="text" name="last_name" class="form-control auth-form-input" placeholder="<?= trans("member_lastname"); ?>" value="<?= old("last_name"); ?>" required>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_fullname"); ?></label>
                        <input type="text" name="fullname" class="form-control auth-form-input" placeholder="<?= trans("member_fullname"); ?>" value="<?= old("fullname"); ?>" required>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_namecard"); ?></label>
                        <input type="text" name="name_on_card" class="form-control auth-form-input" placeholder="<?= trans("member_namecard"); ?>" value="<?= old("name_on_card"); ?>" required>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_address"); ?></label>
                        <input type="text" name="alamat" class="form-control auth-form-input" placeholder="<?= trans("member_address"); ?>" value="<?= old("alamat"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_country"); ?></label>
                        <select name="id_negara" class="form-control">
                            <?php if (!empty($negoro)):
                                foreach ($negoro as $negor):
                                    //$roleName = parseSerializedNameArray($negoro->nama, $activeLang->id); ?>
                                    <option value="<?= $negor->id_negara; ?>"><?= esc($negor->nama); ?></option>
                               <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
					 <div class="form-group">
                        <label><?= trans("member_province"); ?></label>
                        <input type="text" name="propinsi" class="form-control auth-form-input" placeholder="<?= trans("member_province"); ?>" value="<?= old("propinsi"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_city"); ?></label>
                        <input type="text" name="kota" class="form-control auth-form-input" placeholder="<?= trans("member_city"); ?>" value="<?= old("kota"); ?>" required>
                    </div>
					<div class="form-group">
                        <label><?= trans("member_postalcode"); ?></label>
                        <input type="text" name="kode_pos" class="form-control auth-form-input" placeholder="<?= trans("member_postalcode"); ?>" value="<?= old("kode_pos"); ?>" required>
                    </div>
					<input type="hidden" name="role" value="4" required>
    </div>
</div>

