<?php
$oldBlock = "<input
                                type=\"text\"
                                name=\"jabatan\"
                                id=\"jabatan\"
                                class=\"premium-input @error('jabatan') is-invalid @enderror\"
                                placeholder=\"Tulis role karyawan\"
                                value=\"{{ old('jabatan', \$employee->jabatan ?? '') }}\"
                                autocomplete=\"off\"
                            >
                            <span class=\"premium-input-line\"></span>
                        </div>
                        @error('jabatan')
                            <span class=\"premium-error\">{{ \$message }}</span>
                        @enderror
                    </div>";
file_put_contents(__DIR__ . "/old_role_block.b64", base64_encode($oldBlock));
echo "Old block size: " . strlen($oldBlock) . "\n";
echo "B64: " . base64_encode($oldBlock) . "\n";
