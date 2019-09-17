
INCLUDE Irvine32.inc
.data
prompt BYTE "Enter a Integer: ", 0
intVal DWORD ?
sum DWORD ?
XYPos COORD <0, 10>
consoleHandle DWORD ?
.code

main PROC
call Clrscr
INVOKE GetStdHandle, STD_OUTPUT_HANDLE 
mov consoleHandle, eax
INVOKE SetConsoleCursorPosition, consoleHandle, XYPos
mov edx, OFFSET prompt 
call WriteString
call ReadInt
.IF(al == 0dh); Enter key ?
call Crlf
.ELSE

mov intVal, eax
.ENDIF

mov edx, OFFSET prompt
call WriteString
call ReadInt; get a character from keyboard
.IF(al == 0dh); Enter key ?
call Crlf
.ELSE
add eax, intVal
mov sum,eax
call WriteInt
.ENDIF


exit
main ENDP

END main