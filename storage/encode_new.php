<?php
$newBlock = <<<'EOTXT'
                        <div class="role-select" id="roleSelect">
                            <button
                                type="button"
                                class="role-select-trigger @error('jabatan') is-invalid @enderror"
                                id="roleTrigger"
                                aria-haspopup="listbox"
                                aria-expanded="false"
                            >
                                <span class="role-select-value" id="roleValue">
                                    <span class="role-select-placeholder">PILIH ROLE</span>
                                </span>
                                <span class="role-select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                <span class="role-select-glow"></span>
                            </button>

                            <select
                                name="jabatan"
                                id="jabatan"
                                class="role-select-native"
                                aria-hidden="true"
                                tabindex="-1"
                            >
                                <option value="" disabled {{ old('jabatan', $employee->jabatan ?? '') ? '' : 'selected' }}>PILIH ROLE</option>
                                <option value="Creative Director" {{ (old('jabatan', $employee->jabatan ?? '') == 'Creative Director') ? 'selected' : '' }}>Creative Director</option>
                                <option value="Scriptwriter" {{ (old('jabatan', $employee->jabatan ?? '') == 'Scriptwriter') ? 'selected' : '' }}>Scriptwriter</option>
                                <option value="Production Team" {{ (old('jabatan', $employee->jabatan ?? '') == 'Production Team') ? 'selected' : '' }}>Production Team</option>
                                <option value="Intern" {{ (old('jabatan', $employee->jabatan ?? '') == 'Intern') ? 'selected' : '' }}>Intern</option>
                                <option value="Chief Executive Office" {{ (old('jabatan', $employee->jabatan ?? '') == 'Chief Executive Office') ? 'selected' : '' }}>Chief Executive Office</option>
                            </select>

                            <div class="role-select-panel" id="rolePanel" role="listbox">
                                <div class="role-select-panel-inner">
                                    <div class="role-select-panel-header">
                                        <span class="role-select-panel-title">Pilih Role</span>
                                        <span class="role-select-panel-meta">5 Pilihan Tersedia</span>
                                    </div>

                                    <div class="role-select-options">
                                        <button type="button" class="role-option" data-value="Creative Director" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Creative Director</span>
                                            <span class="role-option-icon"><i class="fas fa-palette"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Scriptwriter" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Scriptwriter</span>
                                            <span class="role-option-icon"><i class="fas fa-feather-pointed"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Production Team" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Production Team</span>
                                            <span class="role-option-icon"><i class="fas fa-clapperboard"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Intern" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Intern</span>
                                            <span class="role-option-icon"><i class="fas fa-graduation-cap"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Chief Executive Office" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Chief Executive Office</span>
                                            <span class="role-option-icon"><i class="fas fa-user-tie"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="premium-input-line"></span>

                        @error('jabatan')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>
EOTXT;

file_put_contents(__DIR__ . "/new_role_block.b64", base64_encode($newBlock));
echo "New block size: " . strlen($newBlock) . "\n";
