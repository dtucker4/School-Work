; Tucker_as1.asm 
; SUM = (Aval + Bval) - (Bval + Cval)
.386
.model flat, stdcall
.stack 4096
ExitProcess proto, dwExitCode:dword

.data
Aval DWORD 7
Bval DWORD 5
Cval DWORD 3
Dval DWORD 2
sum DWORD 0

.code
main proc
mov	eax, Aval
add	eax, Bval
mov ebx, Cval
add ebx, Dval
sub eax, ebx
mov sum, eax
mov Aval, eax
invoke ExitProcess, 0
main endp
end main