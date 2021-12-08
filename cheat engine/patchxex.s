.globl _start
_start:
 
# Addresses.
.set Path_00, 0x90EAFD58 # set path. Look in IDA
.set Path, 0x90EAFD68 # 
.set Path_0, 0x90EAFD78 # 
.set Path_1, 0x90EAFD88 # 
.set Path_2, 0x90EAFD98 # 
.set Path_3, 0x90EAFDA8 # 

 
#Use 
.long Path_00
.long (9f-0f)/4
0:
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .align 2
9:

.long Path
.long (9f-0f)/4
0:
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .align 2
9:

 .long Path_0
.long (9f-0f)/4
0:
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .align 2
9:

.long Path_1
.long (9f-0f)/4
0: 
    .byte 0x20
    .byte 0x46
    .byte 0x20
    .byte 0x75
    .byte 0x20
    .byte 0x63
    .byte 0x20
    .byte 0x6b
    .byte 0x20
    .byte 0x6f
    .byte 0x20
    .byte 0x66
    .byte 0x20
    .byte 0x66
    .byte 0x20
    .byte 0x21
    .align 2
9:

.long Path_2
.long (9f-0f)/4
0:
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .align 2
9:

.long Path_3
.long (9f-0f)/4
0:
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .byte 0x20
    .align 2
9:
 
# End of patches (required).
.long 0xFFFFFFFF
.end