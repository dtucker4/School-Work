#include "as2.h"
int cmpScore(void* pName1, void* pName2) {
	int result;
	char name1;
	char name2;
	name1 = ((NODE*)pName1)->first;
	name2 = ((NODE*)pName2)->last;
	if (name1 < name2)
		result = -1;
	else if (name1 > name2)
		result = +1;
	else
		result = 0;
	return result;
}
